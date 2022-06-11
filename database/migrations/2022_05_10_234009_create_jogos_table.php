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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('nome')->unique();
            $table->string('faixa_etaria', 3);
            $table->bigInteger('id_genero')->unsigned();
            $table->bigInteger('id_produtora')->unsigned();
            $table->decimal('valor', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('id_genero')->references('id')->on('generos');
            $table->foreign('id_produtora')->references('id')->on('produtoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogoss');
    }
};
