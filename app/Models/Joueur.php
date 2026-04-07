<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    protected $fillable = [
        'user_id', 'coach_id', 'academie_id', 'prenom', 'nom', 'date_naissance', 
        'nationalite', 'poste', 'pied_fort', 'categorie', 'taille', 'poids', 
        'description', 'statut', 'note_technique', 'note_tactique', 'note_physique', 'avis_coach',
        'matchs_joues', 'buts_marques', 'passes_decisives'
    ];

    public function getAgeAttribute()
    {
        if (!$this->date_naissance) return null;
        return \Carbon\Carbon::parse($this->date_naissance)->age;
    }

    public function user() { return $this->belongsTo(User::class); }
    public function coach() { return $this->belongsTo(Coach::class); }
    public function academie() { return $this->belongsTo(Academie::class); }
    public function videos() { return $this->hasMany(Video::class); }
    public function evaluations() { return $this->hasMany(Evaluation::class)->latest(); }

    public function recruteursFavoris() {
        return $this->belongsToMany(Recruteur::class, 'joueur_recruteur')->withTimestamps();
    }
}
