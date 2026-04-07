@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 bg-slate-50 relative overflow-hidden flex items-center justify-center">
    <!-- Blobs Background -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-benin-green/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-benin-yellow/10 rounded-full blur-3xl"></div>

    <div class="max-w-xl w-full px-6 relative z-10">
        <div class="bg-white rounded-[2rem] p-10 shadow-2xl border border-slate-100 reveal">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-shield-alt text-3xl text-benin-green"></i>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-center text-benin-dark mb-2">Inscription Académie</h2>
            <p class="text-slate-500 text-center mb-10 text-sm">Créez l'espace de votre centre de formation</p>

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl p-4 mb-6 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.academie.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-5">
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom de l'Académie <span class="text-red-500">*</span></label>
                        <input type="text" name="nom_academie" value="{{ old('nom_academie') }}"
                            placeholder="SmartPlayer FC" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ville <span class="text-red-500">*</span></label>
                        <input type="text" name="ville" value="{{ old('ville') }}"
                            placeholder="Cotonou" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Pays <span class="text-red-500">*</span></label>
                        <input type="text" name="pays" value="{{ old('pays') }}"
                            placeholder="Bénin" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email du responsable <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="contact@academie.com" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password"
                            placeholder="Minimum 8 caractères" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation"
                            placeholder="Répétez le mot de passe" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-benin-green hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-green-500/30 transition-all hover:-translate-y-1">
                    Créer mon espace <i class="fas fa-shield-alt ml-2"></i>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <p class="text-sm text-slate-500">Déjà inscrit ? <a href="{{ route('login') }}" class="font-bold text-benin-green hover:underline">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
