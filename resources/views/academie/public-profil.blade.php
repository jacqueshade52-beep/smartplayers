@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <!-- Showcase Banner -->
    <div class="max-w-5xl mx-auto px-6 mb-12">
        <div class="bg-gradient-to-br from-benin-dark to-slate-800 rounded-[3rem] p-10 md:p-16 shadow-2xl relative overflow-hidden group reveal">
            <!-- Arrière-plan stylisé -->
            <div class="absolute inset-0 bg-blobs opacity-[0.08] pointer-events-none">
                <div class="blob bg-white w-64 h-64 blur-3xl rounded-full absolute -top-10 -right-20"></div>
                <div class="blob bg-benin-green w-96 h-96 blur-3xl rounded-full absolute -bottom-32 -left-20"></div>
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                <!-- Logo -->
                <div class="w-40 h-40 md:w-56 md:h-56 rounded-full border-8 border-white/10 bg-white flex items-center justify-center shadow-lg relative shrink-0 overflow-hidden">
                    @if($academie->logo)
                        <img src="{{ asset('storage/' . $academie->logo) }}" alt="{{ $academie->nom ?? 'Académie' }}" class="w-full h-full object-cover rounded-full">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($academie->nom ?? 'Académie') }}&background=008751&color=fff&size=512&font-size=0.33" alt="{{ $academie->nom ?? 'Académie' }}" class="w-full h-full object-cover rounded-full">
                    @endif
                    <!-- Badge vérifié -->
                    <div class="absolute bottom-2 right-2 md:bottom-5 md:right-5 w-10 h-10 md:w-12 md:h-12 bg-benin-yellow text-white rounded-full flex items-center justify-center border-4 border-slate-800 shadow-md transform rotate-12" title="Parternaire Certifié">
                        <i class="fas fa-check text-lg"></i>
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 text-center md:text-left text-white">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-4">
                        <span class="bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-green-300 border border-white/20">
                            <i class="fas fa-shield-alt mr-2"></i> Centre Partenaire
                        </span>
                        <span class="bg-white/10 backdrop-blur-md px-4 py-1.5 rounded-full text-[11px] font-bold text-slate-300 border border-white/20">
                            <i class="fas fa-map-marker-alt mr-2 text-benin-red"></i> {{ $academie->ville ?? '' }}, {{ $academie->pays ?? '' }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">{{ $academie->nom ?? 'Nom Inconnu' }}</h1>
                    
                    <p class="text-slate-300 md:text-lg max-w-2xl leading-relaxed mb-8 opacity-90">{{ $academie->description ?? 'Aucune présentation disponible pour ce centre de formation pour le moment.' }}</p>

                    <!-- Stats Rapides -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-8 bg-white/5 p-4 rounded-2xl border border-white/10 w-fit backdrop-blur-md">
                        <div class="text-center">
                            <span class="block text-2xl font-black text-white">{{ $academie->stats['joueurs'] ?? '0' }}</span>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Talents formés</span>
                        </div>
                        <div class="w-px bg-white/20"></div>
                        <div class="text-center">
                            <span class="block text-2xl font-black text-benin-yellow">{{ $academie->stats['coachs'] ?? '0' }}</span>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Coachs pro</span>
                        </div>
                        <div class="w-px bg-white/20"></div>
                        <div class="text-center">
                            <span class="block text-2xl font-black text-benin-green" title="Note moyenne des joueurs">4.2</span>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Cote globale</span>
                        </div>
                    </div>
                </div>

                <!-- Action Call -->
                <div class="flex flex-col gap-4 mt-6 md:mt-0 w-full md:w-auto">
                    @if(session('role') === 'recruteur')
                        <a href="{{ route('recruteur.contact', $academie->id ?? 1) }}" class="bg-benin-green hover:bg-green-600 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg flex items-center justify-center shadow-green-500/30 text-center hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i> Contacter l'Académie
                        </a>
                        <button class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-8 py-4 rounded-2xl font-bold transition-all flex items-center justify-center backdrop-blur text-center">
                            <i class="fas fa-heart text-benin-red mr-2"></i> Suivre ce centre
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="bg-benin-yellow text-benin-dark px-8 py-4 rounded-2xl font-bold transition-all shadow-lg flex items-center justify-center text-center hover:scale-105">
                            Espace Recruteur requis
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Section Effectifs / Joueurs Validés -->
    <div class="max-w-7xl mx-auto px-6 reveal" style="transition-delay: 100ms;">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-2xl font-extrabold text-benin-dark">Les Talents de l'Académie</h2>
                <p class="text-slate-500 text-sm mt-1">Joueurs évalués, certifiés et disponibles pour recrutement.</p>
            </div>
            
            <!-- Mini filtres -->
            <div class="hidden md:flex gap-2">
                <button class="px-4 py-1.5 rounded-full text-xs font-bold bg-benin-dark text-white">Tous</button>
                <button class="px-4 py-1.5 rounded-full text-xs font-bold border border-slate-200 text-slate-600 hover:border-benin-green">U17</button>
                <button class="px-4 py-1.5 rounded-full text-xs font-bold border border-slate-200 text-slate-600 hover:border-benin-green">U19</button>
            </div>
        </div>

        @if($joueurs && count($joueurs) > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($joueurs as $joueur)
                <!-- On reutilise le composant Player Card -->
                <x-player-card :joueur="(object)$joueur" />
            @endforeach
        </div>
        
        <!-- Pagination Mock -->
        <div class="mt-12 flex justify-center pb-20">
            <button class="bg-white border-2 border-slate-200 text-slate-600 font-bold px-8 py-3 rounded-full hover:border-benin-green hover:text-benin-green transition-all shadow-sm">
                Charger plus de talents <i class="fas fa-sync-alt ml-2 text-xs"></i>
            </button>
        </div>
        @else
        <div class="bg-white rounded-[2rem] p-16 text-center border border-slate-100 shadow-sm mt-8">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mx-auto mb-6 text-4xl">
                <i class="fas fa-ghost"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Aucun talent exposé</h3>
            <p class="text-slate-500 max-w-md mx-auto">Cette académie n'a pas encore de profils validés et rendus publics pour les recruteurs.</p>
        </div>
        @endif
    </div>
</div>
@endsection
