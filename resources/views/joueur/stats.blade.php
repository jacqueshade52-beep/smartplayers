@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('joueur.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-yellow mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Dashboard</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-lg"><i class="fas fa-chart-line"></i></div>
                    Mes Statistiques Avancées
                </h1>
                <p class="text-slate-500 mt-1">Suivez l'évolution de vos performances au fil des matchs et évaluations.</p>
            </div>
            
            <div class="flex gap-2 relative">
                <select class="px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-benin-yellow text-sm bg-white shadow-sm font-semibold text-slate-600">
                    <option>Saison 2025/2026</option>
                    <option>Saison 2024/2025</option>
                </select>
                <a href="{{ route('joueur.rapport', $joueur->id) }}" target="_blank" class="bg-benin-dark text-white px-5 py-3 rounded-xl hover:bg-black transition-colors flex items-center gap-2" title="Générer Rapport">
                    <i class="fas fa-file-pdf"></i> Rapport PDF
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Colonne 1 : Vue Globale -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Chiffres Clés -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 reveal">
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center text-xl mb-3"><i class="fas fa-running"></i></div>
                        <span class="text-3xl font-black text-slate-800">{{ $joueur->matchs_joues ?? 0 }}</span>
                        <span class="text-xs font-bold uppercase text-slate-400 tracking-wider mt-1">Matchs Joués</span>
                    </div>
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-green-50 text-benin-green rounded-full flex items-center justify-center text-xl mb-3"><i class="fas fa-futbol"></i></div>
                        <span class="text-3xl font-black text-slate-800">{{ $joueur->buts_marques ?? 0 }}</span>
                        <span class="text-xs font-bold uppercase text-slate-400 tracking-wider mt-1">Buts</span>
                    </div>
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center text-xl mb-3"><i class="fas fa-hands-helping"></i></div>
                        <span class="text-3xl font-black text-slate-800">{{ $joueur->passes_decisives ?? 0 }}</span>
                        <span class="text-xs font-bold uppercase text-slate-400 tracking-wider mt-1">Passes Dec.</span>
                    </div>
                    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-yellow-50 text-benin-yellow rounded-full flex items-center justify-center text-xl mb-3"><i class="fas fa-star"></i></div>
                        <span class="text-3xl font-black text-slate-800">0</span>
                        <span class="text-xs font-bold uppercase text-slate-400 tracking-wider mt-1">M.O.M</span>
                    </div>
                </div>

                <!-- Simulation Graphe Progress / Performance -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 reveal" style="transition-delay: 100ms;">
                    <h3 class="font-bold text-lg text-benin-dark flex items-center gap-2 mb-6"><i class="fas fa-chart-area text-benin-yellow"></i> Évolution globale des évaluations (Sur 5)</h3>
                    
                    <div class="h-64 flex items-end justify-between px-2 md:px-6 relative text-xs text-slate-400 font-bold border-b border-l border-slate-100 pt-8 pb-2">
                        <!-- Repères fond -->
                        <div class="absolute inset-x-0 bottom-[20%] border-t border-slate-50 border-dashed"></div>
                        <div class="absolute inset-x-0 bottom-[40%] border-t border-slate-50 border-dashed"></div>
                        <div class="absolute inset-x-0 bottom-[60%] border-t border-slate-100 border-dashed"></div>
                        <div class="absolute inset-x-0 bottom-[80%] border-t border-slate-50 border-dashed"></div>
                        
                        <div class="absolute -left-6 bottom-0">0</div>
                        <div class="absolute -left-6 bottom-[40%]">2</div>
                        <div class="absolute -left-6 bottom-[80%]">4</div>
                        <div class="absolute -left-6 top-0">5</div>

                        @forelse ($evaluations as $eval)
                            @php $avg = ($eval->vitesse + $eval->frappe + $eval->vision_jeu + $eval->dribble + $eval->physique + $eval->passe) / 6 / 20; @endphp
                            <div class="relative w-8 md:w-12 flex justify-center group z-10">
                                <div class="absolute -top-10 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity font-bold whitespace-nowrap z-20">{{ number_format($avg, 1) }} / 5</div>
                                <div class="w-full bg-benin-green hover:bg-green-400 transition-all rounded-t-sm shadow-sm" style="height: {{ ($avg / 5) * 100 }}%;"></div>
                                <div class="absolute -bottom-8 w-16 text-center -ml-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($eval->date_evaluation)->format('M d') }}</div>
                            </div>
                        @empty
                            <div class="absolute inset-0 flex items-center justify-center text-slate-300 italic uppercase tracking-wider">Aucune évaluation enregistrée pour le moment.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Colonne 2 : Radar & Morpho -->
            <div class="space-y-8">
                <!-- Le Radar Technique mocké via CSS ou Image (pour le wireframe MVP) -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 text-center reveal" style="transition-delay: 200ms;">
                    <h3 class="font-bold text-lg text-benin-dark flex items-center justify-center gap-2 mb-6"><i class="fas fa-spider text-slate-300"></i> Profil Technico-Tactique</h3>
                    
                    <div class="relative w-48 h-48 mx-auto mb-6">
                        <!-- Simulation d'un radar chart -->
                        <svg class="w-full h-full transform drop-shadow-md" viewBox="0 0 100 100">
                            <polygon points="50,10 90,30 90,70 50,90 10,70 10,30" fill="none" stroke="#f1f5f9" stroke-width="1"/>
                            <polygon points="50,25 75,40 75,60 50,75 25,60 25,40" fill="none" stroke="#e2e8f0" stroke-width="1"/>
                            <!-- Forme Joueur -->
                            <polygon points="50,15 85,35 70,60 50,85 15,65 30,30" fill="#008751" fill-opacity="0.2" stroke="#008751" stroke-width="2"/>
                            
                            <!-- Labels basiques -->
                            <text x="50" y="5" font-size="5" text-anchor="middle" fill="#64748b" font-weight="bold">Technique</text>
                            <text x="95" y="30" font-size="5" text-anchor="start" fill="#64748b" font-weight="bold">Vitesse</text>
                            <text x="95" y="70" font-size="5" text-anchor="start" fill="#64748b" font-weight="bold">Physique</text>
                            <text x="50" y="98" font-size="5" text-anchor="middle" fill="#64748b" font-weight="bold">Défense</text>
                            <text x="5" y="70" font-size="5" text-anchor="end" fill="#64748b" font-weight="bold">Passe</text>
                            <text x="5" y="30" font-size="5" text-anchor="end" fill="#64748b" font-weight="bold">Tir</text>
                        </svg>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-xl text-xs font-bold text-slate-500 border border-slate-100 flex justify-between">
                        <span>Note Moyenne</span>
                        <span class="text-benin-dark text-base">4.1 <span class="text-slate-400 font-normal">/ 5</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Petits ajustements pour rendre les graphs MVP jolis */
.drop-shadow-md { filter: drop-shadow(0 4px 3px rgba(0,0,0,0.07)) drop-shadow(0 2px 2px rgba(0,0,0,0.06)); }
</style>
@endsection
