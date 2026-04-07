@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('academie.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de dashboard</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-benin-yellowLight text-benin-yellow flex items-center justify-center text-lg"><i class="fas fa-users"></i></div>
                    Effectif Global
                </h1>
                <p class="text-slate-500 mt-1">Surveillez l'ensemble des joueurs actuellement en formation dans votre académie.</p>
            </div>
            
            <div class="flex gap-2 relative">
                <input type="text" placeholder="Rechercher un joueur..." class="px-5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-benin-green text-sm bg-white shadow-sm w-full md:w-64">
                <button class="bg-slate-800 text-white px-5 py-3 rounded-xl hover:bg-black transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 reveal">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 font-bold border-y border-slate-100">
                        <tr>
                            <th class="px-4 py-4">Joueur / ID</th>
                            <th class="px-4 py-4">Coach Actuel</th>
                            <th class="px-4 py-4 text-center">Âge</th>
                            <th class="px-4 py-4">Statut de validation</th>
                            <th class="px-4 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($joueurs as $joueur)
                        @php $j = $joueur; @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-4 font-bold text-slate-800 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full border border-slate-200 bg-benin-yellowLight text-benin-yellow flex items-center justify-center font-bold text-lg overflow-hidden shrink-0">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(($j->prenom ?? '') . ' ' . ($j->nom ?? '')) }}&background=fffbea&color=FCD116" alt="Avatar">
                                </div> 
                                <div>
                                    <span class="text-base">{{ $j->prenom ?? '' }} {{ $j->nom ?? '' }}</span>
                                    <div class="text-xs text-slate-400 font-normal mt-0.5">Poste: {{ $j->poste ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-semibold text-slate-700">
                                <i class="fas fa-whistle text-slate-300 mr-2"></i>Coach {{ $j->coach->prenom ?? 'Non assigné' }} ({{ $j->coach->categorie ?? '' }})
                            </td>
                            <td class="px-4 py-4 text-center text-slate-500 font-medium">{{ $j->age ?? '-' }} ans</td>
                            <td class="px-4 py-4">
                                @if(isset($j->statut) && $j->statut === 'validé')
                                    <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-check-circle"></i> Approuvé & Public</span>
                                @elseif(isset($j->statut) && $j->statut === 'en_attente')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-hourglass-half text-xs"></i> En attente de validation</span>
                                @else
                                    <span class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-pencil-alt text-xs"></i> Brouillon Coach</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('joueur.public', $j->id ?? 1) }}" target="_blank" class="inline-flex w-9 h-9 rounded-xl border border-slate-200 text-slate-500 items-center justify-center hover:bg-slate-800 hover:text-white hover:border-slate-800 transition-all shadow-sm" title="Voir la fiche détaillée">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-500">
                                <div class="text-4xl text-slate-300 mb-4"><i class="fas fa-user-slash"></i></div>
                                <p>Aucun joueur inscrit dans l'académie pour le moment.</p>
                                <p class="text-xs mt-2">Dites à vos coachs de les enregistrer.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Mock -->
            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center text-sm font-semibold">
                <span class="text-slate-400">Affichage de 1 à {{ count($joueurs) }} sur {{ count($joueurs) }} joueurs</span>
                <div class="flex gap-2">
                    <button class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
                    <button class="w-8 h-8 rounded-lg bg-benin-dark text-white shadow-md flex items-center justify-center">1</button>
                    <button class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:border-benin-dark flex items-center justify-center transition-all">2</button>
                    <button class="w-8 h-8 rounded-lg outline border border-slate-200 text-slate-600 hover:border-benin-dark flex items-center justify-center transition-all"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
