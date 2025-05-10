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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable(); // Valor por defecto o fallback
        });
        Schema::create('translation_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
            $table->integer('translation_id')
                ->references('id')
                ->on('translations')
                ->onDelete('cascade');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
        Schema::dropIfExists('translation_lang');
    }
};
