<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{
    public function iniciarPagamento(Request $request)
    {

        $publicKey = config('services.mercado_pago.public_key');
        $accessToken = config('services.mercado_pago.access_token');

        $url = "https://api.mercadopago.com/checkout/preferences?access_token={$accessToken}";
        //dd($url);

        $data = [
            "notification_url" => "https://developer.modetc.net.br/webhook",
            "external_reference" => "123456789",
            "items" => [
                [
                    "title" => "Compra02",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => 150.0,
                    "picture_url" => "https://developer.modetc.net.br/storage/imagemProduto/pBPzPoMwELRZynqg0q98MLe1gNBCatdmDAdxawqc.jpg"
                ]
            ]
        ];
        $response = Http::post($url, $data);

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

        $accessToken = config('services.mercado_pago.access_token');

        // Verifique se o Access Token na requisição corresponde ao seu Access Token
        if ($request->header('Authorization') !== 'Bearer ' . $accessToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notificationData = $request->all();
        Log::info('Notificação recebida:', $notificationData);
        // Agora você pode prosseguir com o processamento dos dados da notificação

        // Responda à notificação, se necessário
        return response()->json(['status' => 'ok']);
    }
}








