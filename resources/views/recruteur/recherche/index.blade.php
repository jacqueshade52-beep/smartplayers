@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            @auth
                <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de bord</a>
            @else
                <a href="{{ route('accueil') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour à l'accueil</a>
            @endauth
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-benin-redLight text-benin-red flex items-center justify-center text-lg"><i class="fas fa-search"></i></div>
                Recherche Avancée
            </h1>
            <p class="text-slate-500 mt-1">Filtrez la base de données pour trouver le profil exact dont votre club a besoin.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filtres -->
            <div class="w-full lg:w-80 shrink-0">
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sticky top-24 reveal">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-benin-dark"><i class="fas fa-filter mr-2 text-benin-red"></i> Filtres</h3>
                        <a href="{{ route('explorer') }}" class="text-xs text-slate-400 hover:text-benin-red font-semibold">Réinitialiser</a>
                    </div>

                    <form action="{{ route('recherche') }}" method="GET" class="space-y-6">
                        <!-- Mot-clé -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Recherche textuelle</label>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nom, Prénom ou Académie..." class="w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none font-medium">
                        </div>

                        <!-- Poste -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Poste principal</label>
                            <select name="poste" class="w-full px-4 py-3 text-sm rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none font-medium">
                                <option value="">Tous les postes</option>
                                <option value="Attaquant" {{ request('poste') == 'Attaquant' ? 'selected' : '' }}>Attaquant</option>
                                <option value="Milieu" {{ request('poste') == 'Milieu' ? 'selected' : '' }}>Milieu</option>
                                <option value="Défenseur" {{ request('poste') == 'Défenseur' ? 'selected' : '' }}>Défenseur</option>
                                <option value="Gardien" {{ request('poste') == 'Gardien' ? 'selected' : '' }}>Gardien</option>
                            </select>
                        </div>

                        <!-- Âge -->
                        <div class="pt-6 border-t border-slate-100">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Tranche d'âge</label>
                            <div class="flex items-center gap-3">
                                <input type="number" name="age_min" value="{{ request('age_min') }}" placeholder="Min" class="w-full px-3 py-2 text-sm rounded-lg bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none">
                                <span class="text-slate-400">-</span>
                                <input type="number" name="age_max" value="{{ request('age_max') }}" placeholder="Max" class="w-full px-3 py-2 text-sm rounded-lg bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none">
                            </div>
                        </div>

                        <!-- Évaluation Min -->
                        <div class="pt-6 border-t border-slate-100">
                            <label class="block text-sm font-bold text-slate-700 mb-3">Note technique min (0-100)</label>
                            <input type="number" name="note_min" value="{{ request('note_min') }}" min="0" max="100" placeholder="Ex: 80" 
                                class="w-full px-3 py-2 text-sm rounded-lg bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none font-bold">
                        </div>

                        <button type="submit" class="w-full py-3 bg-benin-red text-white text-sm font-bold rounded-xl shadow-lg shadow-red-500/20 hover:bg-red-700 transition-colors">
                            Appliquer les filtres
                        </button>
                    </form>
                </div>
            </div>

            <!-- Grille Résultats -->
            <div class="flex-1">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-bold text-slate-700">Résultats : <span class="text-benin-red">{{ count($joueurs) }}</span> talents trouvés</h2>
                    <select class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium outline-none text-slate-600 hover:border-slate-300">
                        <option>Trier par : Pertinence</option>
                        <option>Trier par : Note Globale (Décroissant)</option>
                        <option>Trier par : Âge (Croissant)</option>
                        <option>Trier par : Récemment validé</option>
                    </select>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($joueurs as $joueur)
                        <x-player-card :joueur="$joueur" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
