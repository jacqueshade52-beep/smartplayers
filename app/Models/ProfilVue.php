<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilVue extends Model
{
    protected $fillable = ['joueur_id', 'viewer_id', 'ip_address', 'user_agent'];

    public function joueur() { return $this->belongsTo(Joueur::class); }
    public function viewer() { return $this->belongsTo(User::class, 'viewer_id'); }
}
