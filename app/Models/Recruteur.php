<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruteur extends Model
{
    protected $fillable = ['user_id', 'prenom', 'nom', 'organisation', 'fonction', 'site_web'];

    public function user() { return $this->belongsTo(User::class); }

    public function favoris() {
        return $this->belongsToMany(Joueur::class, 'joueur_recruteur')->withTimestamps();
    }
}
