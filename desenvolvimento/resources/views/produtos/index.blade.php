<x-layout title="Retirada">
    <a href="{{ route('home.index') }}" class="btn btn-dark my-3 pr">Home</a>

    <form method="post" action="{{ route('produtos.store') }}">
        @csrf
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Imagem</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade Disponível</th>
                <th scope="col">Quantidade Retirada</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sqls as $sql)
                <tr>
                    <td><img src="{{ asset('storage/' . $sql->imagemProduto) }}" alt="imagem" class="img-fluid"></td>
                    <td>{{ $sql->nome }}</td>
                    <td>{{ $sql->quantidade_total_restante }}</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-secondary decrease">-</button>
                            </div>
                            <input type="text" class="form-control text-center number" name="quantidade[{{ $sql->id_produto_estoque }}]" value="0" readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary increase">+</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($sqls) > 0)
            <button type="submit" class="btn btn-primary">Finalizar Solicitação de Retirada</button>
        @endif
    </form>

    <footer>
        <!--<div id="total">Total: R$ 0.00</div>-->
    </footer>
    <script src="{{ asset('js/produtos.js') }}"></script>
</x-layout>
