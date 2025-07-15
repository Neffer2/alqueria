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
        Schema::create('registro_premios', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreignId('id_user');
            $table->foreign('id_factura')->references('id')->on('facturas');
            $table->foreignId('id_factura');
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreignId('id_estado')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_premios');
    }
};
