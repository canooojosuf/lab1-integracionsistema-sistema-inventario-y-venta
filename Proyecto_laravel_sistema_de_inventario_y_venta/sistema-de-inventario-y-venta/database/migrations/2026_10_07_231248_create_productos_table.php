<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Esto equivale a: id INT AUTO_INCREMENT PRIMARY KEY


            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // aqui estamos modificandola estructura del codigo anterio a Laravel
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->string('marca', 50)->nullable();
            $table->string('medida', 150);
            $table->decimal('precio', 10, 2);
            $table->integer('stock');

            // Aqui se crean las columnas created_at y updated_at automáticamente
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
