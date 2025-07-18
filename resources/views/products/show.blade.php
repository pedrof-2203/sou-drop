<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>
                        <h4>Informações do Produto</h4>
                    </strong>
                    <div>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Editar</a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Voltar</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <strong>
                            <h6 class="mb-"></h6>
                        </strong>
                        <p><strong>Nome:</strong> {{ $product->name }}</p>
                        <p><strong>Cor:</strong> {{ $product->color }}</p>
                        <p><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        <p><strong>Cadastrado em:</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <br>
                    <hr>
                    <div class="col-md-6 mt-3">
                        <strong>
                            <h6>Descrição</h6>
                        </strong>
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
