<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

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
        /*$sqls = DB::table('compras_estoque as ce')
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
            ->get();*/
       /* $sqls = DB::table('produtos_disponiveis as pd')
            ->select('pd.id_produtos_disponiveis', 'e.id_produto_estoque', 'e.nome as nome_produto', 'pd.quantidade', 'e.imagemProduto')
            ->join('estoques as e', 'pd.id_produto_estoque', '=', 'e.id_produto_estoque')
            ->join('usuarios as u', 'pd.id', '=', 'u.id')
            ->where('u.id', '=', $usuario)
            ->get();*/
        $sqls = DB::table('produtos_disponiveis as pd')
            ->select('pd.id_produtos_disponiveis', 'e.id_produto_estoque', 'e.nome as nome_produto', 'pd.quantidade', 'e.imagemProduto')
            ->join('estoques as e', 'pd.id_produto_estoque', '=', 'e.id_produto_estoque')
            ->join('usuarios as u', 'pd.id', '=', 'u.id')
            ->where('u.id', '=', $usuario)
            ->where('pd.quantidade', '>', 0) // Adiciona esta linha para filtrar a quantidade maior que zero
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
    public function processaRetirada($hash)
    {
        $retiradaInfo = DB::table('retiradas')
            ->where('hash', $hash)
            ->where('validacao', 1)
            ->first();

        // Verificar se a hash existe no banco de dados
        if ($retiradaInfo) {

            echo ("teste");
            //return redirect($url);
        } else {
            abort(404);
        }
    }


    public function store(Request $request)
    {
        $dadosRequisicao = $request;
        $hash = Str::random(35);
        $uri = "https://developer.modetc.net/produtos/$hash";
        $quantidades = $request->input('quantidade');
        $nomes = $request->input('nome');
        $id_produto_estoque = $request->input('id_produtos_disponiveis');
        //for ($i = 0; $i < 10000; $i++) {
        $dados = [
            'hash' => $hash
        ];
    //}


        $idRetirada = DB::table('retiradas')->insertGetId($dados);

        foreach ($quantidades as $id_produtos_disponiveis => $quantidade) {

            $dados2 = [
                'id_produtos_disponiveis' => $id_produtos_disponiveis,
                'id_retirada' => $idRetirada,
                'quantidade' => $quantidade,
            ];
            if ($quantidade > 0) {
                DB::table('produtos_disponiveis_retiradas')->insertGetId($dados2);
            }
        }





/*


            $dados = []; // Array para armazenar os dados personalizados

            foreach ($quantidades as $id_produto_estoque => $quantidade) {
                $nome = $nomes[$id_produto_estoque];

                // Construir um array com as informações desejadas
                $dados[] = [
                    'id_produto_estoque' => $id_produto_estoque,
                    'nome' => $nome,
                    'quantidade' => $quantidade,
                ];
            }
        $dataJson = json_encode($dados);*/


        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($uri)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        $qrCodeImage = $result->getString();
        $nomeArquivo = uniqid('qrcode_') . '.png';
        $caminhoArquivo = 'qrcode/' . $nomeArquivo; // Caminho do arquivo no disco 'public'
        Storage::disk('public')->put($caminhoArquivo, $qrCodeImage);
/*
// Crie uma resposta HTTP com o QR Code
        $response = new Response();
        $response->headers->set('Content-Type', $result->getMimeType());
        $response->setContent($result->getString());

// Exiba o QR Code na tela
        $response->send();*/



            // Usar dd() para mostrar os dados personalizados
           // dd($dados);
        return view('produtos.qrcode')->with('qrcode', $caminhoArquivo);

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
