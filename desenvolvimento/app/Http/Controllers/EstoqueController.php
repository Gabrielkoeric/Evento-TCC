<?php

namespace App\Http\Controllers;

use App\Models\Estoques;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estoques = Estoques::all();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('estoques.index')->with('estoques', $estoques)->with('mensagemSucesso', $mensagemSucesso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estoques.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $nome = $request->input('nome');
        //dd($request);
        $quantidadeInicial = $request->input('quantidadeInicial');
        $quantidadeAtual = $request->input('quantidadeAtual');
        $valorCusto = $request->input('valorCusto');
        $valorVenda = $request->input('valorVenda');

        $produto_novo = new Estoques();
        $produto_novo->nome = $nome;
        $produto_novo->quantidade_inicial = $quantidadeInicial;
        $produto_novo->quantidade_atual = $quantidadeAtual;
        $produto_novo->valor_custo = $valorCusto;
        $produto_novo->valor_venda = $valorVenda;
        $produto_novo->save();

        return redirect('/estoque')->with('mensagem.sucesso', 'Produto inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cod_produto_estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Estoques $estoque)
    {
        //dd($estoque);
        return view('estoques.edit')->with('estoque', $estoque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cod_produto_estoque
     * @return \Illuminate\Http\Response
     */
    public function update($estoque, Request $request)
    {
        //dd($request);
        $estoqueObj = Estoques::findOrFail($estoque);

        $estoqueObj->nome = $request->nome;
        $estoqueObj->quantidade_inicial = $request->quantidadeInicial;
        $estoqueObj->quantidade_atual = $request->quantidadeAtual;
        $estoqueObj->valor_custo = $request->valorCusto;
        $estoqueObj->valor_venda = $request->valorVenda;
        $estoqueObj->save();


      /*  $produto_novo->nome = $nome;
        $produto_novo->quantidade_inicial = $qtd_inicial;
        $produto_novo->quantidade_atual = $qtd_atual;
        $produto_novo->valor_custo = $val_custo;
        $produto_novo->valor_venda = $val_venda;*/

        return redirect()->route('estoque.index')->with('mensagem.sucesso', 'Produto Alterado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estoques $estoque)
    {
        $estoque->delete();
        return to_route('estoque.index')->with('mensagem.sucesso', 'Produto Removido com Sucesso do Estoque!');
    }

}
