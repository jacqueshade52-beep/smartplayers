@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-3xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200 text-center">
            <a href="{{ route('academie.coachs') }}" class="text-sm text-slate-400 hover:text-benin-green mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Voir la liste des coachs</a>
            <h1 class="text-3xl font-extrabold text-benin-dark mb-2">Inviter un nouveau Coach</h1>
            <p class="text-slate-500">Créez un profil pour l'éducateur afin qu'il puisse gérer ses joueurs.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('academie.coachs.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800 flex items-start gap-4 mb-8">
                    <i class="fas fa-lock mt-1 text-blue-500 text-xl"></i>
                    <div>
                        <strong>Confidentialité</strong>
                        <p>Lors de la création du compte, ce dernier aura temporairement un mot de passe par défaut. Vous pourrez le transmettre au coach pour qu'il se connecte depuis l'url <a href="{{ route('login') }}" class="font-bold text-blue-700 underline">connexion</a>.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom <span class="text-benin-red">*</span></label>
                        <input type="text" name="prenom" placeholder="Prénom" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-benin-red">*</span></label>
                        <input type="text" name="nom" placeholder="Nom de famille" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email de contact <span class="text-benin-red">*</span></label>
                        <input type="email" name="email" placeholder="coach@academie.com" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie assignée <span class="text-benin-red">*</span></label>
                        <select name="categorie" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-600">
                            <option value="" disabled selected>Choisissez une catégorie de formation...</option>
                            <option value="U15">Formation U15</option>
                            <option value="U17">Formation U17</option>
                            <option value="U19">Formation U19</option>
                            <option value="Réserves">Réserves (Seniors)</option>
                            <option value="Pro">Professionnel</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe temporaire</label>
                        <input type="text" value="Welcome2026" class="w-full px-5 py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 cursor-not-allowed font-mono font-bold" readonly>
                        <p class="text-xs text-slate-400 mt-2 font-medium">À copier et transmettre au coach concerné.</p>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4 mt-8">
                    <a href="{{ route('academie.coachs') }}" class="w-full md:w-auto text-center px-8 py-4 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 shadow-xl shadow-green-500/20 transition-all hover:-translate-y-0.5">Enregistrer le coach</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
