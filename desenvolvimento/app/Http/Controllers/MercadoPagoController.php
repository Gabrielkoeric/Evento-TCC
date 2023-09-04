<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function iniciarPagamento(Request $request)
    {

    }

    public function webhook(Request $request)
    {
        \Log::info('Método store foi chamado após a compra.');
        //dd('$request');
        \Log::info('Método store foi chamado após a compr.');
        // Lógica para tratar notificações de pagamento do Mercado Pago
        // Use o SDK do Mercado Pago para verificar o status do pagamento
    }
}
