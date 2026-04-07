<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoueurController extends Controller
{
    public function dashboard()
    {
        $joueur = auth()->user()->joueur;
        
        // Calcul des vues ce mois-ci
        $vues_ce_mois = \App\Models\ProfilVue::where('joueur_id', $joueur->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Tendance (comparaison mois dernier)
        $last_month = now()->subMonth();
        $vues_hier = \App\Models\ProfilVue::where('joueur_id', $joueur->id)
            ->whereMonth('created_at', $last_month->month)
            ->whereYear('created_at', $last_month->year)
            ->count();
        $taux = $vues_hier > 0 ? round((($vues_ce_mois - $vues_hier) / $vues_hier) * 100) : 0;

        $stats = [
            'vues_profil' => $vues_ce_mois,
            'evolution' => $taux,
            'videos' => $joueur->videos()->count(),
            'note_moyenne' => number_format(($joueur->note_technique + $joueur->note_tactique + $joueur->note_physique) / 3, 1)
        ];
        return view('joueur.dashboard', compact('stats', 'joueur'));
    }

    public function profil()
    {
        $joueur = auth()->user()->joueur;
        return view('joueur.profil.show', compact('joueur'));
    }

    public function editProfil()
    {
        $joueur = auth()->user()->joueur;
        return view('joueur.profil.edit', compact('joueur'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'taille'           => 'nullable|numeric|min:100|max:250',
            'poids'            => 'nullable|numeric|min:30|max:150',
            'description'      => 'nullable|string|max:1000',
            'nationalite'      => 'nullable|string|max:100',
            'matchs_joues'     => 'nullable|integer|min:0',
            'buts_marques'     => 'nullable|integer|min:0',
            'passes_decisives' => 'nullable|integer|min:0',
            'pied_fort'        => 'nullable|string|in:Droit,Gaucher,Ambidextre',
            'note_technique'   => 'nullable|numeric|min:0|max:5',
            'note_tactique'    => 'nullable|numeric|min:0|max:5',
            'note_physique'    => 'nullable|numeric|min:0|max:5',
        ]);

        $joueur = auth()->user()->joueur;
        $joueur->update($request->only([
            'taille', 'poids', 'description', 'nationalite', 'date_naissance', 'pied_fort',
            'matchs_joues', 'buts_marques', 'passes_decisives',
            'note_technique', 'note_tactique', 'note_physique'
        ]));

        return redirect()->route('joueur.profil')->with('success', 'Profil mis à jour avec succès !');
    }

    public function videos()
    {
        $videos = auth()->user()->joueur->videos;
        return view('joueur.videos.index', compact('videos'));
    }

    public function createVideo()
    {
        return view('joueur.videos.create');
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:100',
            'video' => 'required|file|mimetypes:video/mp4,video/quicktime|max:51200', // 50Mo max
        ]);

        $path = $request->file('video')->store('videos', 'public');

        auth()->user()->joueur->videos()->create([
            'titre' => $request->titre,
            'url' => $path,
        ]);

        return redirect()->route('joueur.videos')->with('success', 'Vidéo ajoutée avec succès !');
    }

    public function stats()
    {
        $joueur = auth()->user()->joueur;
        $evaluations = $joueur->evaluations()->orderBy('date_evaluation', 'asc')->get();
        return view('joueur.stats', compact('joueur', 'evaluations'));
    }
    
    // Page publique
    public function showPublic($id)
    {
        $joueur = \App\Models\Joueur::with(['videos', 'user', 'coach.academie', 'evaluations.coach'])->findOrFail($id);

        // Tracker de vues (on ne compte pas les propres vues du joueur si il est connecté)
        if (!auth()->check() || (auth()->user()->joueur && auth()->user()->joueur->id !== $joueur->id)) {
            \App\Models\ProfilVue::create([
                'joueur_id' => $joueur->id,
                'viewer_id' => auth()->id(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        }
        
        return view('joueur.public', compact('joueur'));
    }

    public function rapport($id)
    {
        $joueur = \App\Models\Joueur::with(['user', 'coach.academie', 'evaluations.coach'])->findOrFail($id);
        return view('joueur.rapport', compact('joueur'));
    }
}
