<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Auth::user()->id;
       /* $sqls = DB::table('compras_estoque as ce')
            ->join('compras as c', 'ce.id_compra', '=', 'c.id_compra')
            ->join('estoques as e', 'ce.id_produto_estoque', '=', 'e.id_produto_estoque')
            ->where('c.id', $usuario)
            ->where('c.status', 'concluido')
            ->select('e.nome', DB::raw('SUM(ce.quantidade_restante) as quantidade_total_restante'), DB::raw('MAX(e.imagemProduto) as imagemProduto'))
            ->groupBy('e.nome')
            ->get();*/
        $sqls = DB::table('compras_estoque as ce')
            ->join('compras as c', 'ce.id_compra', '=', 'c.id_compra')
            ->join('estoques as e', 'ce.id_produto_estoque', '=', 'e.id_produto_estoque')
            ->where('c.id', $usuario)
            ->where('c.status', 'concluido')
            ->select(
                'e.id_produto_estoque',
                'e.nome',
                DB::raw('SUM(ce.quantidade_restante) as quantidade_total_restante'),
                DB::raw('MAX(e.imagemProduto) as imagemProduto')
            )
            ->groupBy('e.id_produto_estoque', 'e.nome')
            ->get();


        //dd($sqls);

        return view('produtos.index')->with('sqls', $sqls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quantidades = $request->input('quantidade');
        dd($quantidades);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
