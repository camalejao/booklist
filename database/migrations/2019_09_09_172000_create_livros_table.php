<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('autor_id');
            $table->string('titulo')->unique();
            $table->text('descricao');
            $table->string('categoria');
            $table->enum('status', ['lendo', 'completado', 'desejado', 'desistido', 'pausado']);
            $table->unsignedInteger('avaliacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
