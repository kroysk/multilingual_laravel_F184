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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
        });

        //create a default language
        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'en',
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->integer('language_id')
                ->nullable();
        });

        //create default user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'language_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('language_id');
        });
    }
};
