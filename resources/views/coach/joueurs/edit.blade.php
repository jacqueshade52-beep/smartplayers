@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('coach.joueurs') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour à mes joueurs</a>
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-lg"><i class="fas fa-edit"></i></div>
                Éditer le profil : {{ $joueur->prenom ?? '' }} {{ $joueur->nom ?? '' }}
            </h1>
            <p class="text-slate-500 mt-1">Mettez à jour les informations du joueur.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('coach.joueurs.update', $joueur->id) }}" method="POST" class="space-y-8">
                @csrf                <!-- Identité -->
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom <span class="text-benin-red">*</span></label>
                            <input type="text" name="prenom" value="{{ $joueur->prenom ?? '' }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-benin-red">*</span></label>
                            <input type="text" name="nom" value="{{ $joueur->nom ?? '' }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Date de naissance</label>
                            <input type="date" name="date_naissance" value="{{ $joueur->date_naissance ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie <span class="text-benin-red">*</span></label>
                            <select name="categorie" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all text-slate-600">
                                <option value="U15" {{ (isset($joueur->categorie) && $joueur->categorie == 'U15') ? 'selected' : '' }}>U15</option>
                                <option value="U17" {{ (isset($joueur->categorie) && $joueur->categorie == 'U17') ? 'selected' : '' }}>U17</option>
                                <option value="U19" {{ (isset($joueur->categorie) && $joueur->categorie == 'U19') ? 'selected' : '' }}>U19</option>
                                <option value="U21" {{ (isset($joueur->categorie) && $joueur->categorie == 'U21') ? 'selected' : '' }}>U21</option>
                                <option value="Sénior" {{ (isset($joueur->categorie) && $joueur->categorie == 'Sénior') ? 'selected' : '' }}>Sénior</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sportif -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-running text-slate-400"></i> Profil Sportif</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Poste principal <span class="text-benin-red">*</span></label>
                            <select name="poste" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all text-slate-600">
                                <option value="Gardien de but" {{ (isset($joueur->poste) && $joueur->poste == 'Gardien de but') ? 'selected' : '' }}>Gardien de but</option>
                                <option value="Défenseur central" {{ (isset($joueur->poste) && $joueur->poste == 'Défenseur central') ? 'selected' : '' }}>Défenseur central</option>
                                <option value="Latéral Droit/Gauche" {{ (isset($joueur->poste) && $joueur->poste == 'Latéral Droit/Gauche') ? 'selected' : '' }}>Latéral Droit/Gauche</option>
                                <option value="Milieu défensif/relayeur" {{ (isset($joueur->poste) && $joueur->poste == 'Milieu défensif/relayeur') ? 'selected' : '' }}>Milieu défensif/relayeur</option>
                                <option value="Milieu offensif" {{ (isset($joueur->poste) && $joueur->poste == 'Milieu offensif') ? 'selected' : '' }}>Milieu offensif</option>
                                <option value="Ailier" {{ (isset($joueur->poste) && $joueur->poste == 'Ailier') ? 'selected' : '' }}>Ailier</option>
                                <option value="Avant-centre" {{ (isset($joueur->poste) && $joueur->poste == 'Avant-centre') ? 'selected' : '' }}>Avant-centre</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pied Fort <span class="text-benin-red">*</span></label>
                            <div class="flex items-center gap-4 mt-3">
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="pied_fort" value="Droit" class="accent-benin-green w-4 h-4" {{ (isset($joueur->pied_fort) && strtolower($joueur->pied_fort) == 'droit') ? 'checked' : '' }}> Droit</label>
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="pied_fort" value="Gauche" class="accent-benin-green w-4 h-4" {{ (isset($joueur->pied_fort) && strtolower($joueur->pied_fort) == 'gauche') ? 'checked' : '' }}> Gauche</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biométrie -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-ruler-vertical text-slate-400"></i> Biométrie & Bio</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Taille (cm)</label>
                            <input type="number" name="taille" value="{{ $joueur->taille ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Poids (kg)</label>
                            <input type="number" name="poids" value="{{ $joueur->poids ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Description / Présentation du profil</label>
                        <textarea name="description" rows="3" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">{{ $joueur->description ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Statistiques Saison -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-chart-line text-slate-400"></i> Statistiques Saisonnière (Performances)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Matchs joués</label>
                            <input type="number" name="matchs_joues" value="{{ $joueur->matchs_joues ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Buts</label>
                            <input type="number" name="buts_marques" value="{{ $joueur->buts_marques ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Passes décisives</label>
                            <input type="number" name="passes_decisives" value="{{ $joueur->passes_decisives ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>           </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4">
                    <button type="button" class="px-8 py-3 rounded-xl font-bold text-red-600 bg-red-50 hover:bg-red-100 transition-all mr-auto">Supprimer</button>
                    <a href="{{ route('coach.joueurs') }}" class="px-8 py-3 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 shadow-xl shadow-green-500/20 transition-all hover:-translate-y-0.5">Enregistrer modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
