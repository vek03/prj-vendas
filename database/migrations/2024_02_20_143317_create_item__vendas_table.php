<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item__vendas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_sale');
            $table->foreign('id_sale')->references('id')->on('vendas');

            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('produtos');

            $table->integer('quantity');
            $table->double('price_uni', 10, 2);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item__vendas');
    }
};
