<?php

namespace App\Http\Controllers;

use App\Models\Estoques;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estoques = Estoques::all();
        //dd($estoques);
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('compras.index')->with('estoques', $estoques)->with('mensagemSucesso', $mensagemSucesso);
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
    /*public function store(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados do formulário
            $id_estoque = $_POST["id_estoque"];
            $quantidadeInicial = $_POST["quantidadeInicial"];

            // Verifique se os arrays têm o mesmo tamanho (mesmo número de produtos)
            if (count($id_estoque) == count($quantidadeInicial)) {
                // Itere sobre os dados e exiba cada par id_estoque e quantidadeInicial
                for ($i = 0; $i < count($id_estoque); $i++) {
                    echo "Produto " . ($i + 1) . ":<br>";
                    echo "ID Estoque: " . $id_estoque[$i] . "<br>";
                    echo "Quantidade Inicial: " . $quantidadeInicial[$i] . "<br><br>";
                }
            } else {
                echo "Erro: O número de produtos não corresponde entre id_estoque e quantidadeInicial.";
            }
        }
        //echo ("teste");
        //dd($request);
        //return redirect('/compra')->with('mensagem.sucesso', 'Produto inserido com sucesso!');
        \Log::info('Método store foi chamado.');
        return redirect('/estoque')->with('mensagem.sucesso', 'Produto inserido com sucesso!');
    }*/
    public function store(Request $request)
    {
        // Recupere os dados do formulário
        $id_estoque = $request->input('id_estoque');
        $quantidadeInicial = $request->input('quantidadeInicial');

        // Verifique se os arrays têm o mesmo tamanho (mesmo número de produtos)
        if (count($id_estoque) == count($quantidadeInicial)) {
            // Itere sobre os dados e exiba cada par id_estoque e quantidadeInicial
            for ($i = 0; $i < count($id_estoque); $i++) {
                // Use echo para exibir os valores na tela
                echo "Produto " . ($i + 1) . " - ID Estoque: " . $id_estoque[$i] . " - Quantidade Inicial: " . $quantidadeInicial[$i] . "<br>";
            }
        } else {
            // Em caso de erro, você pode adicionar uma mensagem de erro à sessão, se desejar
            $request->session()->flash('mensagem.erro', 'Erro: O número de produtos não corresponde entre id_estoque e quantidadeInicial.');
        }

        \Log::info('Método store foi chamado.');

        // Redirecione para a rota /estoque
        //return redirect('/estoque');
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
