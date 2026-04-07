@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div>
                <span class="inline-block px-3 py-1 bg-benin-yellowLight text-benin-yellow font-bold text-xs rounded-full uppercase tracking-wider mb-2">Espace Coach</span>
                <h1 class="text-3xl font-extrabold text-benin-dark">Mon Tableau de bord</h1>
                <p class="text-slate-500 mt-1">Supervisez et évaluez vos joueurs.</p>
            </div>
            <div class="hidden md:flex gap-3">
                <a href="{{ route('coach.joueurs.create') }}" class="bg-benin-dark text-white px-5 py-2.5 rounded-xl font-bold hover:bg-black transition-all shadow-lg flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Ajouter Joueur
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Stats -->
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between hover:border-benin-green transition-colors">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Effectif Coaché</p>
                    <p class="text-5xl font-black text-slate-800">{{ $stats['joueurs_suivis'] }} <span class="text-sm font-bold text-slate-400 uppercase">Joueurs</span></p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-benin-green to-[#004d2e] p-8 rounded-[2rem] shadow-xl flex flex-col justify-between text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-blobs opacity-20"><div class="blob bg-white w-40 h-40 blur-3xl -top-10 -right-10"></div></div>
                <div>
                    <p class="text-green-100 text-sm font-bold uppercase tracking-wider mb-1">Validations en attente</p>
                    <p class="text-5xl font-black text-white">{{ $stats['validations_attente'] }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('coach.validations') }}" class="text-sm font-bold text-white bg-white/20 px-4 py-2 rounded-xl backdrop-blur-sm border border-white/30 hover:bg-white/30 transition-all inline-block hover:scale-105">Voir les fiches</a>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between hover:border-benin-yellow transition-colors">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Évaluations du mois</p>
                    <p class="text-5xl font-black text-slate-800">{{ $stats['evaluations_mois'] }} <span class="text-sm font-bold text-slate-400 uppercase">Grilles</span></p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('coach.joueurs') }}" class="text-sm font-bold border border-slate-200 text-slate-600 px-4 py-2 rounded-xl hover:bg-slate-50 hover:border-benin-yellow hover:text-benin-yellow transition-all inline-block">Mettre à jour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
