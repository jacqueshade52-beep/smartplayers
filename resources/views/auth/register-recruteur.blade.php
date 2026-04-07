@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 bg-slate-50 relative overflow-hidden flex items-center justify-center">
    <div class="absolute top-0 left-0 w-96 h-96 bg-benin-red/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-benin-yellow/10 rounded-full blur-3xl"></div>

    <div class="max-w-xl w-full px-6 relative z-10">
        <div class="bg-white rounded-[2rem] p-10 shadow-2xl border border-slate-100 reveal">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-search-dollar text-3xl text-benin-red"></i>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-center text-benin-dark mb-2">Inscription Recruteur</h2>
            <p class="text-slate-500 text-center mb-10 text-sm">Accédez à la base de données des talents africains</p>

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

            <form action="{{ route('register.recruteur.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom <span class="text-red-500">*</span></label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}"
                            placeholder="Marc" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-red-500">*</span></label>
                        <input type="text" name="nom" value="{{ old('nom') }}"
                            placeholder="Dupont" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Club / Organisation <span class="text-red-500">*</span></label>
                        <input type="text" name="organisation" value="{{ old('organisation') }}"
                            placeholder="Ex: Ligue 2 (FR), Agence FIFA" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Fonction</label>
                        <input type="text" name="fonction" value="{{ old('fonction') }}"
                            placeholder="Ex: Directeur sportif, Agent FIFA..."
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email Professionnel <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="marc@club.fr" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password"
                            placeholder="Minimum 8 caractères" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation"
                            placeholder="Répétez le mot de passe" required
                            class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-red focus:bg-white focus:ring-4 focus:ring-red-500/10 outline-none transition-all">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-benin-red hover:bg-red-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-red-500/30 transition-all hover:-translate-y-1">
                    Accéder aux talents <i class="fas fa-search-dollar ml-2"></i>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <p class="text-sm text-slate-500">Déjà inscrit ? <a href="{{ route('login') }}" class="font-bold text-benin-red hover:underline">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
