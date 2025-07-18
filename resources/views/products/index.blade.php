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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                <strong>Cor:</strong>{{ $product->color }}</br>
                                <strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-info btn-sm">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="{{ return confirm('Tem certeza?') }}">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
