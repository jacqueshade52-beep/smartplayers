@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-3xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('joueur.videos') }}" class="text-sm text-slate-400 hover:text-benin-yellow mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour à mes médias</a>
            <h1 class="text-3xl font-extrabold text-benin-dark mb-2">Ajouter un Highlight ou Match</h1>
            <p class="text-slate-500">Intégrez une vidéo Youtube ou Vimeo pour montrer vos compétences en conditions réelles.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('joueur.videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800 flex items-start gap-4 mb-4">
                    <i class="fas fa-video mt-1 text-blue-500 text-xl"></i>
                    <div>
                        <strong>Upload de fichier vidéo</strong>
                        <p>Vous pouvez désormais uploader directement vos fichiers vidéo (MP4, MOV). Taille maximale : <strong>50 Mo</strong>. Privilégiez des vidéos courtes (Highlights).</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Titre de la vidéo <span class="text-benin-red">*</span></label>
                    <input type="text" name="titre" placeholder="Ex: Highlights Saison 2025 - Buts & Passes" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white focus:ring-4 focus:ring-yellow-400/10 outline-none transition-all font-semibold">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Fichier vidéo <span class="text-benin-red">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-file-video text-slate-300"></i>
                        </div>
                        <input type="file" name="video" accept="video/mp4,video/quicktime" required class="w-full pl-11 pr-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-yellow focus:bg-white focus:ring-4 focus:ring-yellow-400/10 outline-none transition-all text-blue-600">
                    </div>
                    <p class="text-xs text-slate-400 mt-2 font-medium">Formats acceptés : <code>MP4, MOV</code></p>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4 mt-8">
                    <a href="{{ route('joueur.videos') }}" class="w-full md:w-auto text-center px-8 py-4 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-xl font-bold text-benin-dark bg-benin-yellow hover:bg-yellow-400 shadow-xl shadow-yellow-500/20 transition-all hover:-translate-y-0.5"><i class="fas fa-cloud-upload-alt mr-2"></i> Télécharger la vidéo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
