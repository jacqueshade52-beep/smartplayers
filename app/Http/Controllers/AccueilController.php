<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        $derniersJoueurs = \App\Models\Joueur::where('statut', 'validé')
            ->with(['evaluations'])
            ->latest()
            ->take(6)
            ->get();

        return view('accueil.index', compact('derniersJoueurs'));
    }
}
