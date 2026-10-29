<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a criação da tabela.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {

            $table->id();

            $table->string('nome');

            $table->decimal('preco', 10, 2);

            $table->boolean('ativo')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Remove a tabela caso seja necessário.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};