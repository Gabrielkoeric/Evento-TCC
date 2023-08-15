<x-layout title="Home">
    <a href="{{route('usuario.index')}}" >
        <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('storage/home/usuario.png') }}" alt="Imagem de capa do card">
            <div class="card-body">
                <h5 href="{{route('usuario.index')}}" class="card-title">Usuarios</h5>
            </div>
        </div>
    </a>

    <a href="{{route('estoque.index')}}" >
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset('storage/home/estoque.png') }}" alt="Imagem de capa do card">
            <div class="card-body">
                <h5 href="{{route('estoque.index')}}" class="card-title">Estoque</h5>
            </div>
        </div>
    </a>


</x-layout>
