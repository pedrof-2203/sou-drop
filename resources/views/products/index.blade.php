<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Meus Produtos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Novo Produto</a>
    </div>

    @if ($products->isEmpty())
        <div class="alert alert-info d-flex justify-content-center gap-3">
            Nenhum produto encontrado.
            <a href="{{ route('products.create') }}" class="text-primary">Cadastre o primeiro!</a>
        </div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md4 mb-4">
                    <div class="card h-100 d-flex flex-column ">
                        <div class="card-body flex-grow-1 p-4">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                <strong>Cor:</strong> {{ $product->color }}</br>
                                <strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-end mb-2">
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary w-20">Ver</a>
                                <a href="{{ route('products.edit', $product) }}"
                                    class="btn btn-secondary w-20">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-20"
                                        onclick="return confirm('Tem certeza?')">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
