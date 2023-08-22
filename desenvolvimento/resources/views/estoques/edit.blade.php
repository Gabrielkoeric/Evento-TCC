<x-layout title="Editar Produto '{{$estoque->nome}}'">
    <x-estoque.forms :action="route('estoque.update', ['estoque' => $estoque->cod_produto_estoque])"
                        :nome="$estoque->nome"
                        :qtd_inicial="$estoque->quantidade_inicial"
                        :qtd_atual="$estoque->quantidade_atual"
                        :valor_custo="$estoque->valor_custo"
                        :valor_venda="$estoque->valor_venda">
    </x-estoque.forms>
</x-layout>


