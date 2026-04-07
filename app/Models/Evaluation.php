<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'joueur_id',
        'coach_id',
        'vitesse',
        'frappe',
        'vision_jeu',
        'dribble',
        'physique',
        'passe',
        'commentaire_coach',
        'date_evaluation'
    ];

    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }
}
