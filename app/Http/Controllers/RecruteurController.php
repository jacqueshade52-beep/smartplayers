<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruteurController extends Controller
{
    public function dashboard()
    {
        $recruteur = auth()->user()->recruteur;
        $stats = [
            'recherches' => \App\Models\RechercheLog::where('user_id', auth()->id())->count(),
            'favoris' => $recruteur->favoris()->count(),
            'messages_non_lus' => auth()->user()->receivedMessages()->where('is_read', false)->count()
        ];
        return view('recruteur.dashboard', compact('stats', 'recruteur'));
    }

    public function explorer()
    {
        // On affiche les joueurs validés ET ceux en attente pour donner plus de visibilité
        $joueurs = \App\Models\Joueur::whereIn('statut', ['validé', 'en_attente'])
            ->with(['evaluations', 'academie', 'user'])
            ->latest()
            ->paginate(12);
            
        return view('recruteur.explorer.index', compact('joueurs'));
    }

    public function recherche(Request $request)
    {
        $query = \App\Models\Joueur::query()->whereIn('statut', ['validé', 'en_attente']);

        // Log de la recherche pour les statistiques du recruteur
        if (auth()->check() && ($request->filled('q') || $request->filled('poste'))) {
            \App\Models\RechercheLog::create([
                'user_id' => auth()->id(),
                'query' => $request->q ?? $request->poste ?? 'Recherche avancée'
            ]);
        }

        // Filtre par mot-clé (Nom, Prénom, Académie)
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function($q) use ($keyword) {
                $q->where('prenom', 'like', "%{$keyword}%")
                  ->orWhere('nom', 'like', "%{$keyword}%")
                  ->orWhereHas('academie', function($aq) use ($keyword) {
                      $aq->where('nom', 'like', "%{$keyword}%");
                  });
            });
        }

        // Filtre par Poste
        if ($request->filled('poste')) {
            $query->where('poste', $request->poste);
        }

        // Filtre par Âge
        if ($request->filled('age_min')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) >= ?', [$request->age_min]);
        }
        if ($request->filled('age_max')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) <= ?', [$request->age_max]);
        }

        // Filtre par Note Technique (uniquement si une note est demandée)
        if ($request->filled('note_min') && $request->note_min > 0) {
            $query->whereHas('evaluations', function($q) use ($request) {
                $q->whereRaw('(vitesse + frappe + vision_jeu + dribble + physique + passe) / 6 >= ?', [$request->note_min]);
            });
        }

        $joueurs = $query->with(['evaluations', 'academie', 'user'])->latest()->get();
        
        return view('recruteur.recherche.index', compact('joueurs'));
    }

    public function favoris()
    {
        $recruteur = auth()->user()->recruteur;
        $joueurs = $recruteur->favoris;
        return view('recruteur.favoris.index', compact('joueurs'));
    }

    public function messages()
    {
        $user = auth()->user();
        
        // On marque tous les messages reçus comme lus lorsqu'on ouvre la messagerie
        $user->receivedMessages()->where('is_read', false)->update(['is_read' => true]);

        $conversations = \App\Models\Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('recruteur.messages.index', compact('conversations'));
    }

    public function toggleFavoris($id)
    {
        $recruteur = auth()->user()->recruteur;
        $recruteur->favoris()->toggle($id);
        
        return back()->with('success', 'Liste de favoris mise à jour.');
    }

    public function contact($academie_id)
    {
        $academie = \App\Models\Academie::findOrFail($academie_id);
        return view('recruteur.contact', compact('academie'));
    }

    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        \App\Models\Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'content' => $request->content,
            'is_read' => false
        ]);

        return redirect()->route('recruteur.messages')
            ->with('success', "Votre message a été envoyé avec succès.");
    }
}
