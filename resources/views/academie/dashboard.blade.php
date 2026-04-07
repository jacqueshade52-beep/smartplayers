@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header Dashboard -->
        <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div>
                <span class="inline-block px-3 py-1 bg-benin-greenLight text-benin-green font-bold text-xs rounded-full uppercase tracking-wider mb-2">Espace Admin</span>
                <h1 class="text-3xl font-extrabold text-benin-dark">Tableau de bord Académie</h1>
                <p class="text-slate-500 mt-1">Gérez votre centre de formation, vos coachs et vos joueurs.</p>
            </div>
            <div class="hidden md:flex gap-3">
                <a href="{{ route('academie.coachs.create') }}" class="bg-white border-2 border-slate-200 text-slate-700 px-5 py-2.5 rounded-xl font-bold hover:border-benin-green hover:text-benin-green transition-all shadow-sm">
                    <i class="fas fa-user-plus mr-2"></i> Nouveau Coach
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:border-benin-green transition-colors">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Coachs Actifs</p>
                    <p class="text-4xl font-black text-slate-800">{{ $stats['coachs'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 text-2xl group-hover:bg-benin-greenLight group-hover:text-benin-green transition-colors">
                    <i class="fas fa-whistle"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:border-benin-yellow transition-colors">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Total Joueurs</p>
                    <p class="text-4xl font-black text-slate-800">{{ $stats['joueurs'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 text-2xl group-hover:bg-benin-yellowLight group-hover:text-benin-yellow transition-colors">
                    <i class="fas fa-running"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:border-benin-red transition-colors">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Vues Recruteurs</p>
                    <p class="text-4xl font-black text-slate-800">{{ $stats['recruteurs_vus'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 text-2xl group-hover:bg-benin-redLight group-hover:text-benin-red transition-colors">
                    <i class="fas fa-eye"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-benin-dark to-slate-800 p-6 rounded-[2rem] shadow-lg flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1 text-white/60">Messages</p>
                    <p class="text-4xl font-black text-white">{{ $stats['messages'] }}</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-white text-2xl backdrop-blur">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>

        <!-- Section Rapide -->
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-benin-dark">Derniers joueurs ajoutés</h3>
                    <a href="{{ route('academie.joueurs') }}" class="text-sm font-semibold text-benin-green hover:underline">Voir tout</a>
                </div>
                <!-- Mini table (Mock) -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="text-xs uppercase bg-slate-50 text-slate-500 font-bold border-y border-slate-100">
                            <tr>
                                <th class="px-4 py-3">Joueur</th>
                                <th class="px-4 py-3 text-center">Âge</th>
                                <th class="px-4 py-3">Poste</th>
                                <th class="px-4 py-3">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-4 font-bold text-slate-800 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center">KJ</div> Koffi Jean
                                </td>
                                <td class="px-4 py-4 text-center text-slate-500">19</td>
                                <td class="px-4 py-4">Milieu off.</td>
                                <td class="px-4 py-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold">Validé</span></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-4 font-bold text-slate-800 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-benin-yellowLight text-benin-yellow flex items-center justify-center">AP</div> Ahoueya Paul
                                </td>
                                <td class="px-4 py-4 text-center text-slate-500">18</td>
                                <td class="px-4 py-4">Défenseur</td>
                                <td class="px-4 py-4"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold">En attente</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gradient-to-br from-benin-green to-[#004d2e] rounded-[2rem] shadow-xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
                <h3 class="text-xl font-bold mb-4 relative z-10">Actions rapides</h3>
                <ul class="space-y-3 relative z-10 w-full mb-6 max-h-[250px] overflow-y-auto no-scrollbar">
                    <li><a href="{{ route('academie.coachs.create') }}" class="block w-full bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-colors font-semibold text-sm"><i class="fas fa-plus mr-2 opacity-70"></i> Ajouter un coach</a></li>
                    <li><a href="{{ route('academie.joueurs') }}" class="block w-full bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-colors font-semibold text-sm"><i class="fas fa-users mr-2 opacity-70"></i> Gérer l'effectif</a></li>
                    <li><a href="{{ route('academie.profil') }}" class="block w-full bg-white/10 hover:bg-white/20 px-4 py-3 rounded-xl transition-colors font-semibold text-sm"><i class="fas fa-building mr-2 opacity-70"></i> Modifier la vitrine</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
