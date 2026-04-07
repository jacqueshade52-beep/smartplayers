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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('joueur_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coach_id')->constrained('coaches')->cascadeOnDelete();
            
            // Notes de 0 à 100
            $table->integer('vitesse')->default(0);
            $table->integer('frappe')->default(0);
            $table->integer('vision_jeu')->default(0);
            $table->integer('dribble')->default(0);
            $table->integer('physique')->default(0);
            $table->integer('passe')->default(0);
            
            $table->text('commentaire_coach')->nullable();
            $table->date('date_evaluation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
