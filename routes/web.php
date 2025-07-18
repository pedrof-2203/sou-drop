<?php

//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// logged-in
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');

    // product routes
    Route::resource('products', ProductController::class);

    // chatbot routes
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
});

require __DIR__ . '/auth.php';
