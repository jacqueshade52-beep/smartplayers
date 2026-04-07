<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['joueur_id', 'titre', 'url', 'plateforme', 'categorie'];

    public function joueur() { return $this->belongsTo(Joueur::class); }
}
