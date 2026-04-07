@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('recruteur.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-red mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de dashboard</a>
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-red-100 text-benin-red flex items-center justify-center text-lg"><i class="fas fa-heart"></i></div>
                Mes Profils Favoris
            </h1>
            <p class="text-slate-500 mt-1">Retrouvez les talents que vous avez présélectionnés pour un suivi particulier.</p>
        </div>

        @if(count($joueurs) > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 reveal">
            @foreach($joueurs as $joueur)
                <div class="relative group">
                    <x-player-card :joueur="(object)$joueur" />
                    <!-- Action Favoris Hover -->
                    <div class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="w-10 h-10 bg-white rounded-full shadow-lg border border-red-50 text-benin-red flex items-center justify-center hover:bg-red-50 hover:scale-110 transition-transform" title="Retirer des favoris">
                            <i class="fas fa-heart-broken"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-[2rem] p-16 text-center border border-slate-100 shadow-sm mt-8 reveal">
            <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center text-benin-red mx-auto mb-6 text-4xl">
                <i class="far fa-heart"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Aucun favori pour le moment</h3>
            <p class="text-slate-500 max-w-md mx-auto mb-8">Utilisez le moteur de recherche pour découvrir les talents et les ajouter à votre liste de suivi.</p>
            <a href="{{ route('recruteur.recherche') }}" class="inline-block bg-benin-red text-white px-8 py-4 rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-500/30">
                Explorer la base de données
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
