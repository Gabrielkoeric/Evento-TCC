<x-layout title="Vendas">
    <a href="{{route('home.index')}}" class="btn btn-dark my-3 pr">Home</a>
    @foreach ($compras->unique('id_compra') as $compra)
        <div>compra numero: {{ $compra->id_compra }}</div>
        <div>status: {{$compra->status}}</div>

        <ul>
            @foreach ($compras->where('id_compra', $compra->id_compra) as $produto)
                <li>{{ $produto->nome_produto }}</li>
            @endforeach
        </ul>
    @endforeach
</x-layout>
