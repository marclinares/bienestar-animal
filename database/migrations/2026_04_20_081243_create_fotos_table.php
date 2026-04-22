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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('ruta');
            
            $table->foreignId('perro_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('gato_id')->nullable()->constrained()->cascadeOnDelete();
            
            $table->timestamps(); // Es recomendable añadir esto también
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
