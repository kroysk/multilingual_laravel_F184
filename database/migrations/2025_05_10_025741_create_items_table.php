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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('item_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')
                ->references('id')
                ->on('items')
                ->delete('cascade');
            $table->integer('language_id')
                ->references('id')
                ->on('languages')
                ->delete('cascade');
            $table->string('name');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_lang');
    }
};
