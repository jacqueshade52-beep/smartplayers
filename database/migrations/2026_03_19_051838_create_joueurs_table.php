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
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coach_id')->nullable()->constrained('coaches')->nullOnDelete();
            $table->foreignId('academie_id')->nullable()->constrained('academies')->nullOnDelete();
            $table->string('prenom');
            $table->string('nom');
            $table->date('date_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('poste')->nullable();
            $table->string('pied_fort')->nullable();
            $table->string('categorie')->nullable(); // U15, U17...
            $table->integer('taille')->nullable(); // cm
            $table->integer('poids')->nullable(); // kg
            $table->text('description')->nullable();
            $table->string('statut')->default('brouillon'); // brouillon, en_attente, validé
            // Notes du coach
            $table->decimal('note_technique', 3, 1)->nullable();
            $table->decimal('note_tactique', 3, 1)->nullable();
            $table->decimal('note_physique', 3, 1)->nullable();
            $table->text('avis_coach')->nullable();
            // Statistiques saison
            $table->integer('matchs_joues')->default(0);
            $table->integer('buts_marques')->default(0);
            $table->integer('passes_decisives')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
