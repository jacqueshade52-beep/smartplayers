@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('coach.joueurs') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour à mes joueurs</a>
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center text-lg"><i class="fas fa-user-plus"></i></div>
                Inscrire un nouveau talent
            </h1>
            <p class="text-slate-500 mt-1">Créez le profil d'un joueur pour commencer à suivre son évolution.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('coach.joueurs.store') }}" method="POST" class="space-y-8">
                @csrf
                <!-- Identité -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-id-card text-slate-400"></i> État Civil</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom <span class="text-benin-red">*</span></label>
                            <input type="text" name="prenom" placeholder="Ex: Jean" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-benin-red">*</span></label>
                            <input type="text" name="nom" placeholder="Ex: Dossou" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email (Compte joueur) <span class="text-benin-red">*</span></label>
                            <input type="email" name="email" placeholder="Ex: joueur@SmartPlayer" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Date de naissance</label>
                            <input type="date" name="date_naissance" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-600">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nationalité</label>
                            <select class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-600">
                                <option>Bénin</option>
                                <option>Togo</option>
                                <option>Côte d'Ivoire</option>
                                <option>Sénégal</option>
                                <option>Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sportif -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-running text-slate-400"></i> Profil Sportif</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Poste principal <span class="text-benin-red">*</span></label>
                            <select name="poste" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-600">
                                <option value="" disabled selected>Sélectionnez un poste...</option>
                                <option>Gardien de but</option>
                                <option>Défenseur central</option>
                                <option>Latéral Droit/Gauche</option>
                                <option>Milieu défensif/relayeur</option>
                                <option>Milieu offensif</option>
                                <option>Ailier</option>
                                <option>Avant-centre</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pied Fort <span class="text-benin-red">*</span></label>
                            <div class="flex items-center gap-4 mt-3">
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="pied_fort" value="Droit" class="accent-benin-green w-4 h-4" checked> Droit</label>
                                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="pied_fort" value="Gauche" class="accent-benin-green w-4 h-4"> Gauche</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie</label>
                            <select name="categorie" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all text-slate-600">
                                <option>U15</option>
                                <option>U17</option>
                                <option selected>U19</option>
                                <option>Senior</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Biométrie -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-ruler-vertical text-slate-400"></i> Biométrie (Actuelle)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Taille (cm)</label>
                            <input type="number" name="taille" placeholder="Ex: 178" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Poids (kg)</label>
                            <input type="number" name="poids" placeholder="Ex: 72" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800 flex items-start gap-4">
                    <i class="fas fa-info-circle mt-1 text-blue-500 text-xl"></i>
                    <div>
                        <strong>Information Processus :</strong>
                        <p>Une fois le joueur ajouté, son statut sera <strong>Brouillon</strong>. Vous pourrez ensuite l'évaluer et soumettre son profil pour validation à votre administrateur académie, ou bien le rendre public s'il est prêt.</p>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4">
                    <a href="{{ route('coach.joueurs') }}" class="px-8 py-3 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="px-8 py-3 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 shadow-xl shadow-green-500/20 transition-all hover:-translate-y-0.5">Enregistrer le profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
