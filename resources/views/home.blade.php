<x-app-layout>
    @if (auth()->check())
        <script>
            window.location.href = "{{ route('products.index') }}";
        </script>
    @else
        <div class="d-flex items-center p-6" style="height: 100vh">
            <div class="bg-primary w-full h-50 rounded">
                <div class="d-flex flex-column align-items-center p-6">
                    <h1 class="display-5 text-white">Boas vindas ao <strong>SouDrop</strong></h1>
                    <strong>
                        <p class="text-lg text-white mt-6">A melhor plataforma de logística do mercado!</p>
                    </strong>
                    <p class="text-lg text-white">Multiplicando suas vendas desde <strong>2025</strong></p>
                    <p class="text-lg text-white mt-6">Faça seu cadastro agora para contar com seu próprio</p>
                    <p class="text-xl text-white"> <strong>Assistente Virtual personalizado!</strong></p>
                    <div class="d-flex gap-2 mt-6">
                        <a href="{{ route('register') }}" class="btn btn-light text-primary text-lg">Cadastro</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
