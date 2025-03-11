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
        Schema::create('header_footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('horaire_admin')->nullable();
            $table->text('horaire_anim')->nullable();
            $table->string('adresse');
            $table->string('email');
            $table->string('phone');
            $table->string('fb_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_footer_settings');
    }
};
