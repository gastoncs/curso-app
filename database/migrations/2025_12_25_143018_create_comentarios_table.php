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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();

            $table->text('comentario');
            $table->unsignedTinyInteger('calificacion')->nullable();

            // Author
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Polymorphic target (Curso OR Instructor)
            $table->morphs('comentable');
            $table->timestamps();

            $table->check('calificacion BETWEEN 0 AND 10');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
