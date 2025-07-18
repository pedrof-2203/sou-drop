# Padrões Laravel Aplicados
## MVC (Model-View-Controller)
- **Model:** *Product* e *User* representam as entidades de dados
- **View:** Interface de usuário através de *.blade.php*
- **Controller:** *ProductController* e *ChatbotController* gerenciam lógica de negócios
## Eloquent ORM
- **Relacionamentos:** *User hasMany Products*, *Product belongsTo User*
- **Mass assignment** com *$fillable* 
- **Casting** de tipos com *$casts*
## Rotas
- Resource routes para CRUD completo
- Middleware para autenticação
- Rotas nomeadas para fácil referência
## Blade Templates
- Layout principal com slots
- Components reutilizáveis
- Diretivas como *@csrf*, *@error*, *@foreach
## Policies
- Autorização baseada em políticas
- Controle de acesso

# Instruções de instalação
```bash
git clone https://github.com/pedrof-2203/sou-drop.git
cd sou-drop
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```
# Preparação do Chatbot
1. Acesse https://console.groq.com/
2. Crie uma conta
3. Gere uma API Key
4. Adicione a key no campo GROQ_API_KEY, no final do arquivo .env
