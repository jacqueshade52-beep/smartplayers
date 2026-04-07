@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <!-- Header Joueur -->
    <div class="max-w-5xl mx-auto px-6 mb-12">
        <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-slate-100 flex flex-col md:flex-row items-center gap-10 reveal">
            <!-- Avatar Géant -->
            <div class="relative">
                <div class="w-48 h-48 rounded-[2rem] overflow-hidden border-8 border-white shadow-2xl relative z-10 bg-benin-greenLight flex items-center justify-center">
                    @if($joueur->user && $joueur->user->photo_profil)
                        <img src="{{ asset('storage/' . $joueur->user->photo_profil) }}" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($joueur->prenom . ' ' . $joueur->nom) }}&background=e6f3ed&color=008751&size=512" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <!-- Badge Statut -->
                @if($joueur->statut === 'validé')
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-benin-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider z-20 shadow-lg border-2 border-white flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> VÉRIFIÉ
                </div>
                @endif
            </div>

            <!-- Infos -->
            <div class="flex-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                    <span class="bg-benin-yellowLight text-benin-dark px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $joueur->poste }}</span>
                    <span class="flex gap-1 text-benin-yellow text-sm">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </span>
                </div>
                <h1 class="text-5xl font-extrabold text-benin-dark mb-4 tracking-tight">{{ $joueur->prenom }} <span class="text-benin-green">{{ $joueur->nom }}</span></h1>
                
                <p class="text-slate-600 mb-6 text-lg leading-relaxed">{{ $joueur->description }}</p>
                
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-100 px-4 py-2 rounded-xl font-medium">
                        <i class="fas fa-shield-alt text-benin-red"></i> {{ $joueur->club }}
                    </div>
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-100 px-4 py-2 rounded-xl font-medium">
                        <i class="fas fa-flag text-benin-green"></i> {{ $joueur->nationalite }}
                    </div>
                </div>
            </div>

            <!-- Actions Recruteur -->
            <div class="flex flex-col gap-3 min-w-[200px]">
                @if(auth()->check() && auth()->user()->role === 'recruteur')
                    @php $isFav = auth()->user()->recruteur->favoris()->where('joueur_id', $joueur->id)->exists(); @endphp
                    <form action="{{ route('recruteur.favoris.toggle', $joueur->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="{{ $isFav ? 'bg-benin-red text-white' : 'bg-white text-benin-red border-2 border-benin-red' }} py-3 px-6 rounded-2xl font-bold shadow-lg shadow-red-500/10 hover:bg-benin-red hover:text-white transition-all hover:-translate-y-1 w-full flex items-center justify-center gap-2">
                            <i class="{{ $isFav ? 'fas' : 'far' }} fa-heart"></i> {{ $isFav ? 'Retirer des Favoris' : 'Mettre en Favori' }}
                        </button>
                    </form>
                    <a href="{{ route('recruteur.messages') }}" class="bg-benin-dark text-white py-3 px-6 rounded-2xl font-bold hover:bg-black transition-all hover:-translate-y-1 w-full flex items-center justify-center gap-2 mt-3 block text-center">
                        <i class="fas fa-comment-dots"></i> Contacter Académie
                    </a>
                @elseif(!auth()->check())
                    <a href="{{ route('login') }}" class="bg-benin-dark text-white py-3 px-6 rounded-2xl font-bold hover:bg-black transition-all hover:-translate-y-1 text-center flex items-center justify-center gap-2">
                        <i class="fas fa-lock mr-1"></i> Se connecter pour contacter
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Stats & Videos -->
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-8">
        <!-- Sidebar Gauche : Données Techniques -->
        <div class="space-y-8 reveal">
            <!-- Mensurations -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="font-extrabold text-xl mb-6 flex items-center gap-2 text-benin-dark"><i class="fas fa-ruler-vertical text-benin-yellow"></i> Biométrie</h3>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Âge</span>
                        <span class="font-bold text-slate-800">{{ $joueur->age }} ans</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Taille</span>
                        <span class="font-bold text-slate-800">{{ $joueur->taille }} cm</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Poids</span>
                        <span class="font-bold text-slate-800">{{ $joueur->poids }} kg</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-slate-500">Pied fort</span>
                        <span class="font-bold text-slate-800">{{ $joueur->pied_fort }}</span>
                    </li>
                </ul>
            </div>

            <!-- Notes Evaluatives -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="font-extrabold text-xl mb-6 flex items-center gap-2 text-benin-dark"><i class="fas fa-chart-radar text-benin-green"></i> Évaluation Coach</h3>
                
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm mb-1 font-semibold">
                            <span>Technique</span>
                            <span class="text-benin-green">{{ $joueur->note_technique }}/5</span>
                        </div>
                        <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-benin-green rounded-full" style="width: {{ ($joueur->note_technique / 5) * 100 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1 font-semibold">
                            <span>Tactique</span>
                            <span class="text-benin-yellow">{{ $joueur->note_tactique }}/5</span>
                        </div>
                        <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-benin-yellow rounded-full" style="width: {{ ($joueur->note_tactique / 5) * 100 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1 font-semibold">
                            <span>Physique</span>
                            <span class="text-benin-red">{{ $joueur->note_physique }}/5</span>
                        </div>
                        <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-benin-red rounded-full" style="width: {{ ($joueur->note_physique / 5) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne Centrale/Droite : Stats & Vidéos -->
        <div class="md:col-span-2 space-y-8 reveal" style="transition-delay: 100ms;">
            <!-- Stats Saison -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="font-extrabold text-xl mb-6 text-benin-dark">Statistiques Saison en cours</h3>
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-slate-50 p-6 rounded-2xl text-center border border-slate-100">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-benin-dark shadow-sm mx-auto mb-3 text-xl"><i class="fas fa-tshirt"></i></div>
                        <p class="text-4xl font-black text-slate-800">{{ $joueur->matchs_joues }}</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1">Matchs</p>
                    </div>
                    <div class="bg-benin-greenLight p-6 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-benin-green shadow-sm mx-auto mb-3 text-xl"><i class="fas fa-futbol"></i></div>
                        <p class="text-4xl font-black text-benin-green">{{ $joueur->buts_marques }}</p>
                        <p class="text-xs font-bold text-benin-green uppercase tracking-wider mt-1 opacity-80">Buts</p>
                    </div>
                    <div class="bg-benin-yellowLight p-6 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-benin-yellow shadow-sm mx-auto mb-3 text-xl"><i class="fas fa-shoe-prints"></i></div>
                        <p class="text-4xl font-black text-benin-yellow">{{ $joueur->passes_decisives }}</p>
                        <p class="text-xs font-bold text-benin-yellow uppercase tracking-wider mt-1 opacity-80">Passes Dé.</p>
                    </div>
                </div>
            </div>

            <!-- Analyse Technique (Radar Chart) -->
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="font-extrabold text-xl mb-6 text-benin-dark">Radar de Compétences</h3>
                    <div class="aspect-square flex items-center justify-center">
                        <canvas id="skillsRadar"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col justify-center">
                    <h3 class="font-extrabold text-xl mb-4 text-benin-dark">Dernier Avis Coach</h3>
                    @if($joueur->evaluations->count() > 0)
                        @php $lastEv = $joueur->evaluations->first(); @endphp
                        <div class="bg-slate-50 p-6 rounded-2xl border-l-4 border-benin-green">
                            <p class="italic text-slate-600 mb-4">"{{ $lastEv->commentaire_coach }}"</p>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-benin-green text-white flex items-center justify-center font-bold">
                                    {{ substr($lastEv->coach->prenom, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-benin-dark">Coach {{ $lastEv->coach->prenom }} {{ $lastEv->coach->nom }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold tracking-tighter">Évalué le {{ \Carbon\Carbon::parse($lastEv->date_evaluation)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-slate-50 p-6 rounded-2xl text-center border border-dashed border-slate-200">
                            <p class="text-slate-400 text-sm">Aucun avis détaillé disponible.</p>
                        </div>
                    @endif
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('skillsRadar');
                    @php
                        $latest = $joueur->evaluations->first();
                        $data = $latest ? [
                            $latest->vitesse,
                            $latest->frappe,
                            $latest->vision_jeu,
                            $latest->dribble,
                            $latest->physique,
                            $latest->passe
                        ] : [50, 50, 50, 50, 50, 50];
                    @endphp

                    new Chart(ctx, {
                        type: 'radar',
                        data: {
                            labels: ['Vitesse', 'Frappe', 'Vision', 'Dribble', 'Physique', 'Passe'],
                            datasets: [{
                                label: 'Niveau Actuel',
                                data: {!! json_encode($data) !!},
                                fill: true,
                                backgroundColor: 'rgba(0, 135, 81, 0.2)',
                                borderColor: '#008751',
                                pointBackgroundColor: '#008751',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: '#008751'
                            }]
                        },
                        options: {
                            elements: {
                                line: { borderWidth: 3 }
                            },
                            scales: {
                                r: {
                                    angleLines: { display: true },
                                    suggestedMin: 0,
                                    suggestedMax: 100,
                                    ticks: { display: false }
                                }
                            },
                            plugins: {
                                legend: { display: false }
                            }
                        }
                    });
                });
            </script>

            <!-- Vidéos -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-extrabold text-xl text-benin-dark">Vidéos Highlights</h3>
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-bold">{{ count($joueur->videos) }} vidéo(s)</span>
                </div>
                
                @if(count($joueur->videos) > 0)
                    <div class="grid gap-6">
                        @foreach($joueur->videos as $video)
                        <div class="group relative rounded-2xl overflow-hidden bg-slate-900 aspect-video flex items-center justify-center cursor-pointer border border-slate-200">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                            <!-- Icone lecture -->
                            <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-full flex items-center justify-center z-20 group-hover:bg-benin-red group-hover:scale-110 transition-all text-white text-xl pl-1">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full p-6 z-20">
                                <h4 class="text-white font-bold text-lg mb-1 group-hover:text-benin-yellow transition-colors">{{ $video['titre'] }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-slate-50 rounded-2xl p-10 text-center border border-dashed border-slate-200">
                        <i class="fas fa-video-slash text-slate-300 text-4xl mb-3"></i>
                        <p class="text-slate-500 font-medium">Aucune vidéo disponible pour ce joueur.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
