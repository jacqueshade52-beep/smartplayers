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
        Schema::create('joueur_recruteur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruteur_id')->constrained('recruteurs')->onDelete('cascade');
            $table->foreignId('joueur_id')->constrained('joueurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueur_recruteur');
    }
};
