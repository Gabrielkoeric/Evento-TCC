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
        $qtd_inicial = $request->input('qtd_inicial');
        $qtd_atual = $request->input('qtd_atual');
        $val_custo = $request->input('val_custo');
        $val_venda = $request->input('val_venda');

        $produto_novo = new Estoques();
        $produto_novo->nome = $nome;
        $produto_novo->quantidade_inicial = $qtd_inicial;
        $produto_novo->quantidade_atual = $qtd_atual;
        $produto_novo->valor_custo = $val_custo;
        $produto_novo->valor_venda = $val_venda;
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
        dd($estoque);
        $estoqueObj = Estoques::findOrFail($estoque);

        $estoqueObj->nome = $request->nome;
        $estoqueObj->email = $request->email;
        $estoqueObj->celular = $request->celular;
        $estoqueObj->permissao = $request->permissao;
        $estoqueObj->save();

        $produto_novo->nome = $nome;
        $produto_novo->quantidade_inicial = $qtd_inicial;
        $produto_novo->quantidade_atual = $qtd_atual;
        $produto_novo->valor_custo = $val_custo;
        $produto_novo->valor_venda = $val_venda;

        return redirect()->route('usuario.index')->with('mensagem.sucesso', 'Usuário Alterado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
