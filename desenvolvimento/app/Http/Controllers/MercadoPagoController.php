<?php

namespace App\Http\Controllers;

use App\Mail\CompraRealizada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MercadoPagoController extends Controller
{
    public function iniciarPagamento(Request $request)
    {
        //dd($request);
        $id = $request->session()->get('pagamnto')['id'];
        $valor = $request->session()->get('pagamnto')['valor'];
        $status = "Aguardando Pagamento";
        //dd("id é $id e valor é $valor");

        $publicKey = config('services.mercado_pago.public_key');
        $accessToken = config('services.mercado_pago.access_token');

        $url = "https://api.mercadopago.com/checkout/preferences?access_token={$accessToken}";
        //dd($url);

        $data = [
            "notification_url" => "https://developer.modetc.net.br/webhook",
            "external_reference" => "$id",
            "items" => [
                [
                    "id" => "$id",
                    "external_reference" => "$id",
                    "title" => "Compra#$id",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => $valor,
                    "picture_url" => "https://developer.modetc.net.br/storage/imagemProduto/pBPzPoMwELRZynqg0q98MLe1gNBCatdmDAdxawqc.jpg"
                ]
            ]
        ];
        $response = Http::post($url, $data);
        //dd($response);
        $responseData = $response->json();
        //email
        $link = $responseData['init_point'];
        $usuario = Auth::user();
        $status = "concluido";
        $email = new CompraRealizada($valor, $status, $link);
        Mail::to($usuario->email)->queue($email);

// Verifique se a resposta foi bem-sucedida
        if ($response->status() == 201) {
            $responseData = $response->json();

            return redirect($responseData['init_point']);
            //dd($responseData);
        } else {
            // Lida com erros de requisição
            $responseBody = $response->body();
            return redirect($responseBody['init_point']);
            //dd($responseBody);
            //dd("deu ruin");
        }

    }

    public function webhook(Request $request)
    {

        $requestJson = json_encode([
            'headers' => $request->headers->all(),
            'content' => $request->getContent(),
            'query' => $request->query->all(),
            'request' => $request->request->all(),
            'server' => $request->server->all(),
            'cookies' => $request->cookies->all(),
            'files' => $request->files->all(),
        ], JSON_PRETTY_PRINT);

        // Registre a requisição completa nos logs
        //Log::info('Requisição completa:', ['request' => $requestJson]);

        // Chave de acesso (access token) do Mercado Pago
        $accessToken = config('services.mercado_pago.access_token');

        $authorizationHeader = $request->header('Authorization');

        $signature = $request->header('X-Signature');

// Registre o cabeçalho de autorização nos logs para depuração
      //  Log::info('x-signature: ' . $signature);
      //  Log::info('Cabeçalho de Autorização:', ['Authorization' => $authorizationHeader]);
      //  Log::info('accessToken:', ['accessToken' => $accessToken]);

        // Verifique se o Access Token na requisição corresponde ao seu Access Token
        if ($request->header('Authorization') !== 'Bearer ' . $accessToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        // Obtenha os dados da notificação
        $notificationData = $request->all();

        // Verifique se o campo 'id' está presente nos dados da notificação
        if (isset($notificationData['id'])) {
            $orderId = $notificationData['id'];
            Log::info('Compra identificada. ID da compra:', ['order_id' => $orderId]);
        } else {
            Log::info('Compra não identificada. Dados da notificação:', $notificationData);
        }


        // Registre os dados da notificação nos logs
        Log::info('Notificação recebida:', $notificationData);

        // Agora você pode prosseguir com o processamento dos dados da notificação

        // Responda à notificação, se necessário
        return response()->json(['status' => 'ok']);
    }

/*    public function webhook(Request $request)
    {

        $accessToken = config('services.mercado_pago.access_token');

        // Verifique se o Access Token na requisição corresponde ao seu Access Token
        if ($request->header('Authorization') !== 'Bearer ' . $accessToken) {
            $notificationData = $request->all();
            Log::info('Notificação recebida:', $notificationData);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notificationData = $request->all();
        Log::info('Notificação recebida:', $notificationData);
        // Agora você pode prosseguir com o processamento dos dados da notificação

        // Responda à notificação, se necessário
        return response()->json(['status' => 'ok']);
    }*/
}








