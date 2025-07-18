<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <strong><h4>Assistente Virtual</h4></strong>
                    <small class="text-muted">Pergunte sobre seus produtos cadastrados</small>
                </div>
                <div class="card-body">
                    <div id="chat-messages" class="mb-4" style="height: 400px; overflow-y: auto; border: 1px solid #dee2e6; padding: 15px; border-radius: 5px;">
                        <div class="alert alert-info">
                            <strong>Olá!</strong> Eu sou seu assistente virtual. Posso ajudá-lo com informações sobre seus produtos.
                            <br><br>
                            Exemplos de perguntas:
                            <ul class="mb-0">
                                <li>"Quais produtos são azuis?"</li>
                                <li>"Liste os 5 produtos mais caros"</li>
                                <li>"Qual é o produto mais barato?"</li>
                                <li>"Quantos produtos eu tenho?"</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" id="question-input" class="form-control" 
                               placeholder="Digite sua pergunta..." maxlength="500">
                        <button class="btn btn-primary" id="send-btn">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chat-messages');
            const questionInput = document.getElementById('question-input');
            const sendBtn = document.getElementById('send-btn');

            function addMessage(message, isUser = false) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `alert ${isUser ? 'alert-primary' : 'alert-secondary'} mb-2`;
                messageDiv.innerHTML = `<strong>${isUser ? 'Você' : 'Assistente'}:</strong> ${message}`;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function sendQuestion() {
                const question = questionInput.value.trim();
                if (!question) return;

                addMessage(question, true);
                questionInput.value = '';
                sendBtn.disabled = true;
                sendBtn.textContent = 'Enviando...';

                fetch('{{ route("chatbot.ask") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ question: question })
                })
                .then(response => response.json())
                .then(data => {
                    addMessage(data.answer);
                })
                .catch(error => {
                    addMessage('Erro ao enviar pergunta. Tente novamente.');
                    console.error('Error:', error);
                })
                .finally(() => {
                    sendBtn.disabled = false;
                    sendBtn.textContent = 'Enviar';
                    questionInput.focus();
                });
            }

            sendBtn.addEventListener('click', sendQuestion);
            questionInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendQuestion();
                }
            });

            questionInput.focus();
        });
    </script>
</x-app-layout>