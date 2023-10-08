<?php

namespace App\Http\Controllers;

use App\Mail\CompraRealizada;
use App\Models\Estoques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use mysql_xdevapi\Table;

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


    public function store(Request $request)
    {
        $info = $request;
        //dd($info);
        $usuario = Auth::user()->id;
        $quantidade = $request->input('quantidade');
        $estoque_id = $request->input('estoque_id');
        $valor = 0;
        $hash = Str::random(35);
        $status = "Aguardando pagamento";
        if (count($estoque_id) == count($quantidade)) {
            for ($i = 0; $i < count($estoque_id); $i++) {
                $valorProduto = DB::table('estoques')
                    ->where('id_produto_estoque', $estoque_id[$i])
                    ->value('valor_venda');
                $valor = $valor + ($valorProduto * $quantidade[$i]);

               // echo("valor da compra é: $valor - ");
            }
        }

        $dados = [
            'id' => $usuario,
            'valor' => $valor,
            'status' => 'aguardando pagamento',
            'hash' => $hash
        ];
        $idInserido = DB::table('compras')->insertGetId($dados);

        $pagamento = [
            'id' => $idInserido,
            'valor' => $valor,
            'hash' => $hash
        ];

        //email
       /* $usuario = Auth::user();
        $email = new CompraRealizada($valor, $status);
        Mail::to($usuario->email)->queue($email);*/

        // Verifique se os arrays têm o mesmo tamanho (mesmo número de produtos)
        if (count($estoque_id) == count($quantidade)) {
            for ($i = 0; $i < count($estoque_id); $i++) {
                echo ("$estoque_id[$i] -");
                echo ("$quantidade[$i]");

                $dados2 = [
                    'id_compra' => $idInserido,
                    'id_produto_estoque' => $estoque_id[$i],
                    'quantidade_compra' => $quantidade[$i],
                    'quantidade_restante' => $quantidade[$i]
                ];
                DB::table('compras_estoque')->insert($dados2);

            }
        }
        Log::info("id $idInserido, valor $valor, hash $hash");
        return redirect('/payment')->cookie('id', $idInserido)->cookie('valor', $valor)->cookie('hash', $hash);
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
