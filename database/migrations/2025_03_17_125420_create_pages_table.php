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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('template')->default('default'); // template à utiliser
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->boolean('is_home')->default(false); // Est-ce la page d'accueil ?
            $table->boolean('show_in_menu')->default(true); // Afficher dans le menu ?
            $table->integer('menu_order')->default(0); // Ordre dans le menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
