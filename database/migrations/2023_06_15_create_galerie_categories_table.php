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
        Schema::create('galerie_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Ajouter la colonne galerie_category_id à la table galeries si elle existe
        if (Schema::hasTable('galeries')) {
            Schema::table('galeries', function (Blueprint $table) {
                if (!Schema::hasColumn('galeries', 'galerie_category_id')) {
                    $table->foreignId('galerie_category_id')->nullable()->constrained()->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la clé étrangère de la table galeries si elle existe
        if (Schema::hasTable('galeries') && Schema::hasColumn('galeries', 'galerie_category_id')) {
            Schema::table('galeries', function (Blueprint $table) {
                $table->dropForeign(['galerie_category_id']);
                $table->dropColumn('galerie_category_id');
            });
        }

        Schema::dropIfExists('galerie_categories');
    }
}; 