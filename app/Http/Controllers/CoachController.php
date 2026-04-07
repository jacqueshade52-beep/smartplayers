<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function dashboard()
    {
        $coach = auth()->user()->coach;
        $stats = [
            'joueurs_suivis' => $coach->joueurs()->count(),
            'evaluations_total' => \App\Models\Evaluation::where('coach_id', $coach->id)->count(),
            'evaluations_mois' => \App\Models\Evaluation::where('coach_id', $coach->id)->whereMonth('created_at', now()->month)->count(),
            'validations_attente' => $coach->joueurs()->whereIn('statut', ['brouillon', 'en_attente'])->count()
        ];
        return view('coach.dashboard', compact('stats', 'coach'));
    }

    public function mesJoueurs()
    {
        $coach = auth()->user()->coach;
        $joueurs = $coach->joueurs;
        
        return view('coach.joueurs.index', compact('joueurs', 'coach'));
    }

    public function createJoueur()
    {
        return view('coach.joueurs.create');
    }

    public function storeJoueur(Request $request)
    {
        $request->validate([
            'prenom'         => 'required|string|max:255',
            'nom'            => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'poste'          => 'required|string',
            'date_naissance' => 'nullable|date',
            'pied_fort'      => 'nullable|string',
            'taille'         => 'nullable|integer',
            'poids'          => 'nullable|integer',
            'categorie'      => 'nullable|string'
        ], [
            'email.unique' => 'Un compte existe déjà avec cet email.'
        ]);

        // Générer un mot de passe temporaire lisible
        $tempPassword = 'FT_' . strtoupper(substr($request->prenom, 0, 3)) . rand(1000, 9999);

        $user = \App\Models\User::create([
            'name'     => $request->prenom . ' ' . $request->nom,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($tempPassword),
            'role'     => 'joueur',
        ]);

        $coach = auth()->user()->coach;

        $joueur = $user->joueur()->create([
            'prenom'         => $request->prenom,
            'nom'            => $request->nom,
            'coach_id'       => $coach->id,
            'academie_id'    => $coach->academie_id,
            'poste'          => $request->poste,
            'date_naissance' => $request->date_naissance,
            'pied_fort'      => $request->pied_fort ?? 'Droit',
            'taille'         => $request->taille,
            'poids'          => $request->poids,
            'categorie'      => $request->categorie ?? 'U19',
            'statut'         => 'brouillon'
        ]);

        $msg = "✅ Joueur {$joueur->prenom} {$joueur->nom} ajouté ! Mot de passe temporaire : <strong>{$tempPassword}</strong> — Transmettez-le lui pour qu'il se connecte et complète son profil.";

        return redirect()->route('coach.joueurs')->with('success', $msg);
    }

    public function updateJoueur(Request $request, $id)
    {
        $joueur = \App\Models\Joueur::findOrFail($id);
        
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'poste' => 'required|string',
            'date_naissance' => 'nullable|date',
            'pied_fort' => 'nullable|string',
            'taille' => 'nullable|integer',
            'poids' => 'nullable|integer',
            'categorie' => 'required|string'
        ]);

        $joueur->update($request->all());

        return redirect()->route('coach.joueurs')
            ->with('success', "Profil de {$joueur->prenom} mis à jour avec succès.");
    }

    public function editJoueur($id)
    {
        $joueur = \App\Models\Joueur::findOrFail($id);
        return view('coach.joueurs.edit', compact('joueur'));
    }

    public function createEvaluation($joueur_id)
    {
        $joueur = \App\Models\Joueur::findOrFail($joueur_id);
        return view('coach.evaluations.create', compact('joueur'));
    }

    public function storeEvaluation(Request $request, $joueur_id)
    {
        $request->validate([
            'vitesse' => 'required|integer|min:0|max:100',
            'frappe' => 'required|integer|min:0|max:100',
            'vision_jeu' => 'required|integer|min:0|max:100',
            'dribble' => 'required|integer|min:0|max:100',
            'physique' => 'required|integer|min:0|max:100',
            'passe' => 'required|integer|min:0|max:100',
            'commentaire_coach' => 'nullable|string',
            'date_evaluation' => 'required|date'
        ]);

        $joueur = \App\Models\Joueur::findOrFail($joueur_id);
        
        $joueur->evaluations()->create([
            'coach_id' => auth()->user()->coach->id,
            'vitesse' => $request->vitesse,
            'frappe' => $request->frappe,
            'vision_jeu' => $request->vision_jeu,
            'dribble' => $request->dribble,
            'physique' => $request->physique,
            'passe' => $request->passe,
            'commentaire_coach' => $request->commentaire_coach,
            'date_evaluation' => $request->date_evaluation
        ]);

        return redirect()->route('coach.joueurs')
            ->with('success', 'Évaluation enregistrée avec succès pour ' . $joueur->prenom);
    }

    public function validations()
    {
        $coach = auth()->user()->coach;
        // On affiche tout ce qui n'est pas déjà validé
        $joueurs = $coach->joueurs()->where('statut', '!=', 'validé')->get();
        return view('coach.validations', compact('joueurs'));
    }

    public function validateJoueur(Request $request, $id)
    {
        $joueur = \App\Models\Joueur::findOrFail($id);
        $joueur->update(['statut' => 'validé']);

        return redirect()->route('coach.validations')
            ->with('success', "Le profil de {$joueur->prenom} a été validé avec succès !");
    }

    public function rejectJoueur(Request $request, $id)
    {
        $joueur = \App\Models\Joueur::findOrFail($id);
        $joueur->update(['statut' => 'brouillon']);

        return redirect()->route('coach.validations')
            ->with('success', "Le profil de {$joueur->prenom} a été renvoyé en brouillon pour corrections.");
    }
}
