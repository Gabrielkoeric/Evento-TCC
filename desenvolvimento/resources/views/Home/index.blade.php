<x-layout title="Home">
    <a href="{{route('cor.index')}}" class="btn btn-dark mb-2">Painel</a>
    <!-- <a href="{{route('marca.index')}}" class="btn btn-dark mb-2">Marcas</a>
    <a href="{{route('modelo.index')}}" class="btn btn-dark mb-2">Modelos</a>   -->
    <a href="{{route('usuario.index')}}" >
        <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="" alt="Imagem de capa do card">
            <div class="card-body">
                <h5 href="{{route('usuario.index')}}" class="card-title">Título do card</h5>
            </div>
        </div>
    </a>


</x-layout>
