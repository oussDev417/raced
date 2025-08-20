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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('momo_number')->nullable();
            $table->string('moov_number')->nullable();
            $table->string('cetiis_number')->nullable();
            $table->string('mail_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['momo_number', 'moov_number', 'cetiis_number', 'mail_link']);
        });
    }
};
