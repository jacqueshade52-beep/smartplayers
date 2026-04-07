@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('joueur.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-yellow mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de dashboard</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-lg"><i class="fas fa-video"></i></div>
                    Mes Clips & Médias
                </h1>
                <p class="text-slate-500 mt-1">Gérez vos vidéos highlights pour valoriser votre profil.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('joueur.videos.create') }}" class="bg-benin-dark hover:bg-black text-white px-5 py-3 rounded-xl font-bold transition-all shadow-lg flex items-center text-sm md:text-base whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i> Ajouter une vidéo
                </a>
            </div>
        </div>

        @if(count($videos) > 0)
        <!-- Galerie de vidéos -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 reveal">
            @foreach($videos as $video)
                <div class="bg-white rounded-[2rem] p-4 shadow-sm border border-slate-100 group relative">
                    <!-- Overlay Options Vidéo (Hover) -->
                    <div class="absolute top-6 right-6 z-20 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                        <button class="w-8 h-8 rounded-full bg-white text-slate-500 flex items-center justify-center shadow-lg hover:text-benin-red transition-colors"><i class="fas fa-trash-alt"></i></button>
                    </div>

                    <div class="relative w-full aspect-video bg-slate-900 rounded-2xl overflow-hidden shadow-inner mb-4">
                        <video class="w-full h-full object-cover opacity-80" preload="metadata">
                            <source src="{{ asset('storage/' . $video->url) }}" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                        
                        <!-- Bouton Lecture Central -->
                        <div class="absolute inset-0 z-10 flex items-center justify-center">
                            <a href="{{ asset('storage/' . $video->url) }}" target="_blank" class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white text-2xl group-hover:bg-benin-red group-hover:scale-110 transition-all pl-1 border border-white/30 shadow-[0_0_20px_rgba(0,0,0,0.3)]">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="px-2 pb-2">
                        <h3 class="font-bold text-slate-800 text-lg mb-1 leading-tight group-hover:text-benin-yellow transition-colors line-clamp-2">{{ $video->titre }}</h3>
                        <p class="text-xs font-semibold text-slate-400">Ajoutée le {{ $video->created_at->format('d/m/Y') }} <span class="mx-1">•</span> <i class="fas fa-file-video text-slate-300"></i> Local</p>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <!-- Empty State Videos -->
        <div class="bg-white rounded-[2rem] p-16 text-center border border-slate-100 shadow-sm mt-8 reveal">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-6 text-4xl">
                <i class="fas fa-film"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Aucune vidéo n'a été ajoutée</h3>
            <p class="text-slate-500 max-w-md mx-auto mb-8">Les recruteurs regardent très souvent les vidéos avant d'engager un contact. Ne laissez pas votre profil sans compilation !</p>
            <a href="{{ route('joueur.videos.create') }}" class="inline-block bg-benin-dark text-white px-8 py-4 rounded-2xl font-bold hover:bg-black transition-all shadow-lg hover:-translate-y-1">
                <i class="fas fa-cloud-upload-alt mr-2"></i> Lier ma première vidéo YouTube
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
