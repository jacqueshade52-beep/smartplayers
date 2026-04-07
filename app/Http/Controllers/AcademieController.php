<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademieController extends Controller
{
    public function dashboard()
    {
        $academie = auth()->user()->academie;
        $stats = [
            'coachs' => $academie->coaches()->count(),
            'joueurs' => $academie->joueurs()->count(),
            'recruteurs_vus' => 0,
            'messages' => auth()->user()->receivedMessages()->where('is_read', false)->count()
        ];
        return view('academie.dashboard', compact('stats', 'academie'));
    }

    public function coachs()
    {
        $academie = auth()->user()->academie;
        $coachs = $academie->coaches;
        return view('academie.coachs.index', compact('coachs'));
    }

    public function createCoach()
    {
        return view('academie.coachs.create');
    }

    public function editCoach($id)
    {
        $coach = \App\Models\Coach::findOrFail($id);
        return view('academie.coachs.edit', compact('coach'));
    }

    public function updateCoach(Request $request, $id)
    {
        $coach = \App\Models\Coach::findOrFail($id);
        
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string'
        ]);

        $coach->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'categorie' => $request->categorie
        ]);

        // Mettre à jour aussi le nom de l'utilisateur
        $coach->user->update([
            'name' => $request->prenom . ' ' . $request->nom
        ]);

        return redirect()->route('academie.coachs')
            ->with('success', "Le coach {$coach->prenom} a été mis à jour.");
    }

    public function deleteCoach($id)
    {
        $coach = \App\Models\Coach::findOrFail($id);
        $coach->user->delete(); // Supprime l'utilisateur et le coach par cascade (si configuré)
        
        return redirect()->route('academie.coachs')
            ->with('success', "Le coach a été supprimé.");
    }

    public function storeCoach(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'categorie' => 'required|string'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->prenom . ' ' . $request->nom,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make('Welcome2026'),
            'role' => 'coach',
        ]);

        $user->coach()->create([
            'academie_id' => auth()->user()->academie->id,
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'categorie' => $request->categorie
        ]);

        return redirect()->route('academie.coachs')
            ->with('success', "Le coach {$request->prenom} {$request->nom} a été invité avec succès.");
    }

    public function updateProfil(Request $request)
    {
        $academie = auth()->user()->academie;
        
        $request->validate([
            'nom'           => 'required|string|max:255',
            'ville'         => 'required|string',
            'pays'          => 'required|string',
            'description'   => 'nullable|string',
            'email_contact' => 'nullable|email',
            'site_web'      => 'nullable|url',
            'logo'          => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['nom', 'ville', 'pays', 'description', 'email_contact', 'site_web']);

        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo si il existe
            if ($academie->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($academie->logo);
            }
            $data['logo'] = $request->file('logo')->store('academies/logos', 'public');
        }

        $academie->update($data);

        return redirect()->route('academie.dashboard')
            ->with('success', "Profil de l'académie mis à jour avec succès.");
    }

    public function joueurs()
    {
        $academie = auth()->user()->academie;
        // On affiche tous les joueurs rattachés à l'académie
        $joueurs = $academie->joueurs()->with('coach')->get();
        return view('academie.joueurs.index', compact('joueurs'));
    }

    public function profil()
    {
        $academie = auth()->user()->academie;
        
        if (!$academie) {
            return redirect()->route('accueil')->with('error', 'Accès non autorisé ou profil académie non trouvé.');
        }

        return view('academie.profil', compact('academie'));
    }

    public function showPublic($id)
    {
        $academie = \App\Models\Academie::findOrFail($id);
        
        // On attache manuellement les stats pour la vue
        $academie->stats = [
            'joueurs' => $academie->joueurs()->where('statut', 'validé')->count(),
            'coachs' => $academie->coaches()->count()
        ];

        $joueurs = $academie->joueurs()
            ->where('statut', 'validé')
            ->with(['user', 'evaluations', 'academie'])
            ->get();

        return view('academie.public-profil', compact('academie', 'joueurs'));
    }
}
