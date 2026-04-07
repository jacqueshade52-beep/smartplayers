@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('joueur.profil') }}" class="text-sm text-slate-400 hover:text-benin-yellow mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Mon profil détaillé</a>
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-lg"><i class="fas fa-edit"></i></div>
                Mettre à jour mon profil de talent
            </h1>
            <p class="text-slate-500 mt-1">Gardez vos statistiques et votre description à jour pour maximiser vos chances d'être repéré.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            
            <!-- Section Photos (Avatar & Couverture) -->
            <div class="mb-12 pb-10 border-b border-slate-100">
                <h3 class="text-xl font-bold flex items-center gap-2 mb-8 text-benin-dark"><i class="fas fa-camera text-slate-400"></i> Photos du profil</h3>
                
                <form action="{{ route('profile.update-photos') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @csrf
                    <!-- Photo de Profil -->
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-700">Photo de profil (Carrée, max 2Mo)</label>
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-24 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-200 overflow-hidden flex items-center justify-center shrink-0">
                                @if(auth()->user()->photo_profil)
                                    <img src="{{ asset('storage/' . auth()->user()->photo_profil) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-user text-3xl text-slate-300"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="photo_profil" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                                <button type="submit" class="mt-3 text-xs font-bold text-benin-green hover:underline">Appliquer la photo</button>
                            </div>
                        </div>
                    </div>

                    <!-- Photo de Couverture -->
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-slate-700">Photo de couverture (Large, max 3Mo)</label>
                        <div class="flex flex-col gap-3">
                            <div class="h-24 w-full rounded-2xl bg-slate-100 border-2 border-dashed border-slate-200 overflow-hidden flex items-center justify-center">
                                @if(auth()->user()->photo_couverture)
                                    <img src="{{ asset('storage/' . auth()->user()->photo_couverture) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-image text-3xl text-slate-300"></i>
                                @endif
                            </div>
                            <input type="file" name="photo_couverture" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                            <button type="submit" class="mt-1 text-xs font-bold text-benin-green hover:underline text-left">Appliquer la couverture</button>
                        </div>
                    </div>
                </form>
            </div>

            <form action="{{ route('joueur.profil.update') }}" method="POST" class="space-y-8">
                @csrf
                <!-- Biométrie personnelle -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-balance-scale text-slate-400"></i> Données Morphologiques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Taille actuelle (cm)</label>
                            <input type="number" name="taille" value="{{ $joueur->taille ?? '' }}" min="100" max="250" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white focus:ring-4 focus:ring-yellow-400/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Poids actuel (kg)</label>
                            <input type="number" name="poids" value="{{ $joueur->poids ?? '' }}" min="30" max="200" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white focus:ring-4 focus:ring-yellow-400/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pied Fort</label>
                            <select name="pied_fort" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all">
                                <option value="Droit" {{ ($joueur->pied_fort == 'Droit') ? 'selected' : '' }}>Droit</option>
                                <option value="Gaucher" {{ ($joueur->pied_fort == 'Gaucher') ? 'selected' : '' }}>Gaucher</option>
                                <option value="Ambidextre" {{ ($joueur->pied_fort == 'Ambidextre') ? 'selected' : '' }}>Ambidextre</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nationalité</label>
                            <input type="text" name="nationalite" value="{{ $joueur->nationalite ?? '' }}" placeholder="Ex: Béninois" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Évaluations Auto-déclarées -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-star text-slate-400"></i> Auto-évaluation (Notes /5)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Note Technique</label>
                            <input type="range" name="note_technique" min="0" max="5" step="0.5" value="{{ $joueur->note_technique ?? 0 }}" oninput="this.nextElementSibling.value = this.value" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-benin-green">
                            <output class="text-sm font-bold text-benin-green mt-2 block">{{ $joueur->note_technique ?? 0 }}</output>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Note Tactique</label>
                            <input type="range" name="note_tactique" min="0" max="5" step="0.5" value="{{ $joueur->note_tactique ?? 0 }}" oninput="this.nextElementSibling.value = this.value" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-benin-yellow">
                            <output class="text-sm font-bold text-benin-yellow mt-2 block">{{ $joueur->note_tactique ?? 0 }}</output>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Note Physique</label>
                            <input type="range" name="note_physique" min="0" max="5" step="0.5" value="{{ $joueur->note_physique ?? 0 }}" oninput="this.nextElementSibling.value = this.value" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-red-500">
                            <output class="text-sm font-bold text-red-500 mt-2 block">{{ $joueur->note_physique ?? 0 }}</output>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-4 italic"><i class="fas fa-info-circle mr-1"></i> Soyez honnête sur vos notes, votre coach peut les valider ou les ajuster à tout moment.</p>
                </div>

                <!-- Bio -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-pen text-slate-400"></i> Ma Description (Pitch)</h3>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Décrivez-vous en tant que joueur : Qualités, Mentalité...</label>
                        <textarea name="description" rows="4" class="w-full px-5 py-4 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all resize-none shadow-inner">{{ $joueur->description ?? '' }}</textarea>
                    </div>
                </div>
                
                <!-- Statistiques Saison -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-chart-bar text-slate-400"></i> Statistiques de la Saison</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2"><i class="fas fa-futbol text-slate-400 mr-1"></i> Matchs joués</label>
                            <input type="number" name="matchs_joues" value="{{ $joueur->matchs_joues ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2"><i class="fas fa-crosshairs text-slate-400 mr-1"></i> Buts marqués</label>
                            <input type="number" name="buts_marques" value="{{ $joueur->buts_marques ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2"><i class="fas fa-hands-helping text-slate-400 mr-1"></i> Passes décisives</label>
                            <input type="number" name="passes_decisives" value="{{ $joueur->passes_decisives ?? 0 }}" min="0" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Données gelées -->
                <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl">
                    <h4 class="font-bold text-slate-600 mb-3 text-sm flex items-center gap-2"><i class="fas fa-lock text-slate-400"></i> Informations fixes</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-xs font-semibold text-slate-500 transition-all">
                        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                            <span class="block text-slate-400 uppercase tracking-widest text-[10px]">Identité</span>
                            <p class="text-slate-800 text-sm mt-1 truncate">{{ $joueur->prenom ?? '' }} {{ $joueur->nom ?? '' }}</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                            <span class="block text-slate-400 uppercase tracking-widest text-[10px]">Poste</span>
                            <p class="text-slate-800 text-sm mt-1">{{ $joueur->poste ?? '-' }}</p>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                            <span class="block text-slate-400 uppercase tracking-widest text-[10px]">Date de naissance</span>
                            <p class="text-slate-800 text-sm mt-1">{{ $joueur->date_naissance ?? '-' }}</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 font-medium mt-4 text-center w-full">Contactez votre coach pour modifier votre identité ou votre poste.</p>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4 mt-8">
                    <a href="{{ route('joueur.profil') }}" class="px-8 py-4 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="px-8 py-4 rounded-xl font-bold text-benin-dark bg-benin-yellow hover:bg-yellow-400 shadow-xl shadow-yellow-500/20 transition-all hover:-translate-y-0.5"><i class="fas fa-save mr-2"></i> Mettre à jour mon profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
