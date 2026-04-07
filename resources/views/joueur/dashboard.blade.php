@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div>
                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 font-bold text-xs rounded-full uppercase tracking-wider mb-2">Espace Joueur</span>
                <h1 class="text-3xl font-extrabold text-benin-dark">Espace Personnel</h1>
                <p class="text-slate-500 mt-1">Mettez en avant votre talent.</p>
            </div>
            <div class="hidden md:flex gap-3">
                <a href="{{ route('joueur.rapport', $joueur->id) }}" target="_blank" class="bg-slate-800 hover:bg-black text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg flex items-center">
                    <i class="fas fa-file-download mr-2 text-benin-yellow"></i> Rapport CV
                </a>
                <a href="{{ route('joueur.profil.edit') }}" class="bg-benin-green hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Éditer profil
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="md:col-span-2 bg-gradient-to-r from-benin-dark to-slate-800 p-8 rounded-[2rem] shadow-xl text-white relative flex flex-col justify-center">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/40 to-transparent h-1/2 pointer-events-none"></div>
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <p class="text-slate-300 font-medium mb-1">Vues de votre profil (ce mois)</p>
                        <p class="text-5xl font-black">
                            {{ $stats['vues_profil'] }} 
                            <span class="text-sm font-bold uppercase tracking-widest {{ $stats['evolution'] >= 0 ? 'text-benin-yellow' : 'text-red-400' }}">
                                <i class="fas fa-arrow-{{ $stats['evolution'] >= 0 ? 'up' : 'down' }}"></i> 
                                {{ $stats['evolution'] > 0 ? '+' : '' }}{{ $stats['evolution'] }}%
                            </span>
                        </p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center text-benin-yellow text-3xl shadow-inner backdrop-blur">
                        <i class="fas fa-fire"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 text-center hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mx-auto mb-3 text-xl drop-shadow"><i class="fas fa-video"></i></div>
                <p class="text-4xl font-black text-slate-800 mb-1">{{ $stats['videos'] }}</p>
                <p class="text-xs font-bold text-slate-500 uppercase">Clips vidéo</p>
                <a href="{{ route('joueur.videos') }}" class="mt-4 text-xs font-bold text-benin-green hover:underline">Gérer mes médias</a>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 text-center hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center text-benin-yellow mx-auto mb-3 text-xl drop-shadow"><i class="fas fa-star text-benin-yellow"></i></div>
                <p class="text-4xl font-black text-slate-800 mb-1">{{ $stats['note_moyenne'] }}/5</p>
                <p class="text-xs font-bold text-slate-500 uppercase">Note Moyenne</p>
                <a href="{{ route('joueur.stats') }}" class="mt-4 text-xs font-bold text-benin-yellow hover:underline">Voir mes stats</a>
            </div>
        </div>
    </div>
</div>
@endsection
