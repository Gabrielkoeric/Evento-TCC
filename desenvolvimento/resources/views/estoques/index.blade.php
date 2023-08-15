<x-layout title="Estoque">
    <a href="{{route('home.index')}}" class="btn btn-dark mb-2">Home</a>
    <a href="{{route('estoque.create')}}" class="btn btn-dark mb-2">Adicionar Produto ao estoque</a>

    @isset($mensagemSucesso)
        <div class="alert alert-success">{{ $mensagemSucesso }}</div>
    @endisset
    <ul class="list-group">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($estoques as $estoque)
                    <tr>
                        <td><a href="{{ route('estoque.edit', $usuario->id ) }}" class="text-decoration-none text-dark">{{ $usuario->nome_completo }}</a></td>
                        <td><a href="{{ route('usuario.edit', $usuario->id) }}" class="text-decoration-none text-dark">{{ $usuario->email }}</a></td>
                        <td><a href="{{ route('usuario.edit', $usuario->id) }}" class="text-decoration-none text-dark">{{ $usuario->celular }}</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>

    </ul>
</x-layout>



