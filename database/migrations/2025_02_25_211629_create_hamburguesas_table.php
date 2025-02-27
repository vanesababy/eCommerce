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
        Schema::create('hamburguesas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('descripcion');
            $table->set('disponible', ['si', 'no']);
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hamburguesas');
    }
};
