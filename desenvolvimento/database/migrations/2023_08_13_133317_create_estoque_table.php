<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id('cod_produto_estoque');
            $table->string('nome');
            $table->integer('quantidade_inicial');
            $table->integer('quantidade_atual');
            $table->decimal('valor_custo', 10, 2); // Altere conforme necessário
            $table->decimal('valor_venda', 10, 2); // Altere conforme necessário
            $table->timestamps();
        });
        DB::statement('ALTER TABLE estoque COMMENT = "Tabela referente à inserção de dados de estoque."');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
