@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div>
                <span class="inline-block px-3 py-1 bg-benin-redLight text-benin-red font-bold text-xs rounded-full uppercase tracking-wider mb-2">Espace Recruteur</span>
                <h1 class="text-3xl font-extrabold text-benin-dark">Tableau de bord Recruteur</h1>
                <p class="text-slate-500 mt-1">Gérez vos recherches et vos prises de contact.</p>
            </div>
            <div class="hidden md:flex gap-3">
                <a href="{{ route('recherche') }}" class="bg-benin-red hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg flex items-center">
                    <i class="fas fa-search mr-2"></i> Recherche Avancée
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between hover:border-benin-red transition-colors text-center">
                <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-benin-red mx-auto mb-4 text-2xl drop-shadow"><i class="fas fa-search-plus"></i></div>
                <p class="text-4xl font-black text-slate-800 mb-1">{{ $stats['recherches'] }}</p>
                <p class="text-xs font-bold text-slate-500 uppercase">Recherches Effectuées</p>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between hover:border-red-400 transition-colors text-center">
                <div class="relative w-16 h-16 mx-auto mb-4">
                    <div class="absolute inset-0 bg-red-50 rounded-2xl animate-pulse"></div>
                    <div class="relative w-full h-full flex items-center justify-center text-red-500 text-2xl drop-shadow"><i class="fas fa-heart"></i></div>
                </div>
                <p class="text-4xl font-black text-slate-800 mb-1">{{ $stats['favoris'] }}</p>
                <p class="text-xs font-bold text-slate-500 uppercase">Profils Favoris</p>
                <a href="{{ route('recruteur.favoris') }}" class="mt-4 text-xs font-bold text-red-500 hover:underline">Voir les favoris</a>
            </div>

            <div class="bg-gradient-to-br from-benin-dark to-slate-800 p-8 rounded-[2rem] shadow-xl text-white relative text-center">
                <div class="w-16 h-16 bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center text-white mx-auto mb-4 text-2xl drop-shadow border border-white/20"><i class="fas fa-inbox"></i></div>
                <p class="text-4xl font-black text-white mb-1">{{ $stats['messages_non_lus'] }}</p>
                <p class="text-xs font-bold text-slate-300 uppercase">Messages Non-Lus</p>
                <a href="{{ route('recruteur.messages') }}" class="mt-4 text-xs font-bold text-white hover:underline bg-white/20 px-4 py-2 rounded-xl inline-block mt-4">Accéder</a>
            </div>
        </div>
    </div>
</div>
@endsection
