<x-layout title="Home">
    <div class="container">
        <div class="row">
            @foreach ($sqls as $sql)
                <div class="col-md-4 col-lg-3 mb-">
                    <a href="{{ route($sql->nome_tela . '.index') }}" class="text-decoration-none">
                        <div class="card text-center">
                            <img src="{{ asset($sql->imagem_tela) }}" class="card-img-top" alt="Imagem de capa do card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #495057">{{$sql->nome}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>


