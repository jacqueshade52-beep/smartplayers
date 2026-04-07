<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ['user_id', 'academie_id', 'prenom', 'nom', 'categorie'];

    public function user() { return $this->belongsTo(User::class); }
    public function academie() { return $this->belongsTo(Academie::class); }
    public function joueurs() { return $this->hasMany(Joueur::class); }
}
