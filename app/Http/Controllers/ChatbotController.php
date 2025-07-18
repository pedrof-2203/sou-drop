<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        $products = Product::where('user_id', $user->id)->latest()->get();

        if ($products->isEmpty()) {
            return response()->json([
                'answer' => 'Você ainda não tem produtos cadastrados. 
                            Cadastre alguns produtos primeiro para que eu possa ajudar.',
            ]);
        }

        $productsData = $products->map(function ($product) {
            return [
                'nome' => $product->name,
                'color' => $product->color,
                'preco' => $product->price,
                'descricao' => $product->description,
            ];
        })->toArray();

        try {
            $client = new Client();
            $response = $client->post('https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'llama3-8b-8192',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Você é um assistente virtual para uma plataforma de logística online. 
                                        Responda sempre em português brasileiro.
                                        Você tem acesso aos seguintes produtos do usuário: ' 
                                        . json_encode($productsData) . '. Responda perguntas sobre estes produtos de forma clara e útil. 
                                        Se perguntarem sobre produtos que não existem na lista, informe que não há produtos cadastrados com essas características.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $request->question
                        ]
                    ],
                    'max_tokens' => 300,
                    'temperature' => 0.7,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $answer = $data['choices'][0]['message']['content'] ?? 'Desculpe, não consegui processar sua pergunta. Quer tentar novamente?';

            return response()->json(['answer' => $answer]);

        } catch (\Exception $e) {
            return response()->json([
                'answer' => 'Desculpe, houve um erro ao processar sua pergunta. Tente novamente mais tarde. ',
            ], 500);
        }
    }
}
