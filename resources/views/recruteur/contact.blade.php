@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-3xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ url()->previous() }}" class="text-sm text-slate-400 hover:text-benin-red mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour</a>
            <h1 class="text-3xl font-extrabold text-benin-dark mb-2">Contacter le centre de formation</h1>
            <p class="text-slate-500">Initiez une discussion avec <strong>{{ $academie->nom ?? 'l\'Académie' }}</strong> concernant l'un de leurs joueurs.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <!-- Profil Académie Cible -->
            <div class="flex items-center gap-4 mb-10 pb-6 border-b border-slate-100">
                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-400 overflow-hidden shrink-0 border-2 border-slate-200">
                     <img src="https://ui-avatars.com/api/?name={{ urlencode($academie->nom ?? 'Académie') }}&background=f1f5f9" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-xl text-slate-800">{{ $academie->nom ?? 'Académie Inconnue' }}</h3>
                    <p class="text-sm text-slate-500"><i class="fas fa-map-marker-alt text-benin-red mr-1"></i> {{ $academie->ville ?? '' }}, {{ $academie->pays ?? '' }}</p>
                </div>
            </div>

            <form action="{{ route('messages.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $academie->user_id }}">
                
                <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-sm text-red-800 flex items-start gap-4 mb-6">
                    <i class="fas fa-shield-alt mt-1 text-red-500 text-xl"></i>
                    <div>
                        <strong>Mise en relation sécurisée</strong>
                        <p>Les échanges via SmartPlayer garantissent le suivi des jeunes talents. Nous vous rappelons que les clauses contractuelles se discutent après accord du centre.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Sujet de votre démarche <span class="text-benin-red">*</span></label>
                    <select name="subject" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all text-slate-600">
                        <option value="Demande d'informations complémentaires">Demande d'informations complémentaires sur un joueur</option>
                        <option value="Demande de vidéos">Demande de vidéos (Highlights, Matchs entiers)</option>
                        <option value="Invitation à un essai">Invitation à un essai (Trial)</option>
                        <option value="Proposition de partenariat">Proposition de partenariat</option>
                        <option value="Autre motif">Autre motif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Joueur concerné (Optionnel)</label>
                    <input type="text" name="joueur_nom" placeholder="Entrez le nom ou l'ID si la demande concerne un talent spécifique" value="{{ request('joueur') ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Votre Message <span class="text-benin-red">*</span></label>
                    <textarea name="content" rows="6" placeholder="Soyez précis dans votre demande pour obtenir une réponse rapide du coach ou du directeur de l'académie..." required class="w-full px-5 py-4 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white outline-none transition-all resize-none"></textarea>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4 mt-8">
                    <a href="{{ url()->previous() }}" class="px-8 py-4 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all text-center">Annuler</a>
                    <button type="submit" class="px-8 py-4 rounded-xl font-bold text-white bg-benin-red hover:bg-red-700 shadow-xl shadow-red-500/20 transition-all hover:-translate-y-0.5 text-center"><i class="fas fa-paper-plane mr-2"></i> Envoyer la demande</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
