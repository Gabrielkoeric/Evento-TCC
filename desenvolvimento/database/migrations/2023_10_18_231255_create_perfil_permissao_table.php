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
        Schema::create('perfil_permissao', function (Blueprint $table) {
            $table->id('id_perfil_permissao');

            $table->unsignedBigInteger('id_home');
            $table->unsignedBigInteger('id_perfil');

            $table->foreign('id_home')->references('id_home')->on('home');
            $table->foreign('id_perfil')->references('id_perfil')->on('perfil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_permissao');
    }
};
