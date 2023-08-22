<form action="{{$action}}" method="post">
    @csrf
    @isset($nome)
        @method('PUT')
    @endisset
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" @isset($nome) value="{{$nome}}" @endisset>

        <label for="qtd_inicial" class="form-label">Qtd. Inicial</label>
        <input type="number" id="qtd_inicial" name="quantidade_inicial" class="form-control" @isset($qtd_inicial) value="{{$qtd_inicial}}" @endisset>

        <label for="qtd_atual" class="form-label">Qtd. Atual</label>
        <input type="number" id="qtd_atual" name="quantidade_atual" class="form-control" @isset($quantidade_atual) value="{{$quantidade_atual}}" @endisset>

        <label for="val_custo" class="form-label">Valor Custo</label>
        <input type="number" id="val_custo" name="valor_custo" class="form-control" step="0.01" @isset($valor_custo) value="{{$valor_custo}}" @endisset>

        <label for="val_venda" class="form-label">Valor Venda</label>
        <input type="number" id="val_venda" name="valor_venda" class="form-control" step="0.01" @isset($valor_venda) value="{{$valor_venda}}" @endisset>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{route('estoque.index')}}" class="btn btn-danger">Cancelar</a>
    @isset($nome)
        <form action="{{route('estoque.destroy', $nome)}}" method="post" class="ms-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Excluir</button>
        </form>
    @endisset
</form>
