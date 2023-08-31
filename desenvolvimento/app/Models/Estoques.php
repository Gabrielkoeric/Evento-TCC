<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Estoques extends Model
{
    use HasFactory;

    protected $primaryKey = 'cod_produto_estoque';
    protected $fillable = ['cod_produto_estoque', 'nome', 'quantidade_inicial', 'quantidade_atual', 'valor_custo', 'valor_venda', 'imagemProduto'];
}

