<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academie extends Model
{
    protected $fillable = ['user_id', 'nom', 'ville', 'pays', 'description', 'logo', 'email_contact', 'site_web'];

    public function user() { return $this->belongsTo(User::class); }
    public function coaches() { return $this->hasMany(Coach::class); }
    public function joueurs() { return $this->hasMany(Joueur::class); }
}
