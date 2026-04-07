@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <!-- Header Joueur -->
    <div class="max-w-5xl mx-auto px-6 mb-12">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('joueur.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-yellow inline-block"><i class="fas fa-arrow-left mr-1"></i> Dashboard</a>
            <a href="{{ route('joueur.profil.edit') }}" class="bg-white border-2 border-slate-200 text-slate-700 px-5 py-2 rounded-xl font-bold hover:border-benin-yellow hover:text-benin-yellow transition-all shadow-sm flex items-center gap-2">
                <i class="fas fa-edit"></i> Modifier mes infos
            </a>
        </div>

        <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-slate-100 flex flex-col md:flex-row items-center gap-10 reveal">
            <!-- Avatar -->
            <div class="relative">
                <div class="w-48 h-48 rounded-[2rem] overflow-hidden border-8 border-white shadow-2xl relative z-10 bg-benin-yellowLight">
                    @if($joueur->user->photo_profil)
                        <img src="{{ asset('storage/' . $joueur->user->photo_profil) }}" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($joueur->prenom . ' ' . $joueur->nom) }}&background=fffbea&color=FCD116&size=512" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <!-- Badge Statut -->
                @if($joueur->statut === 'validé')
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-benin-green text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider z-20 shadow-lg border-2 border-white flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-check-circle"></i> VALIDÉ & PUBLIC
                </div>
                @else
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-yellow-500 text-white px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider z-20 shadow-lg border-2 border-white flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-hourglass-half"></i> EN ATTENTE COACH
                </div>
                @endif
            </div>

            <!-- Infos -->
            <div class="flex-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $joueur->poste }}</span>
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $joueur->age }} ans</span>
                </div>
                <h1 class="text-4xl font-extrabold text-benin-dark mb-4 tracking-tight">{{ $joueur->prenom }} <span class="text-benin-yellow">{{ $joueur->nom }}</span></h1>
                
                <p class="text-slate-600 mb-6 text-base leading-relaxed max-w-2xl">{{ $joueur->description }}</p>
                
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-50 px-4 py-2 rounded-xl font-medium border border-slate-100">
                        <i class="fas fa-shield-alt text-slate-300"></i> {{ $joueur->club }}
                    </div>
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-50 px-4 py-2 rounded-xl font-medium border border-slate-100">
                        <i class="fas fa-ruler-vertical text-slate-300"></i> {{ $joueur->taille }} cm
                    </div>
                    <div class="flex items-center gap-2 text-slate-700 bg-slate-50 px-4 py-2 rounded-xl font-medium border border-slate-100">
                        <i class="fas fa-weight-hanging text-slate-300"></i> {{ $joueur->poids }} kg
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block w-px h-32 bg-slate-100"></div>

            <div class="text-center">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Pied fort</p>
                <div class="w-16 h-16 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center mx-auto text-benin-yellow text-2xl mb-1 shadow-sm">
                    <i class="fas fa-shoe-prints"></i>
                </div>
                <span class="font-bold text-slate-700">{{ $joueur->pied_fort }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
