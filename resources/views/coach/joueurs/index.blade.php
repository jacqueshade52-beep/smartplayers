@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('coach.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de bord</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-benin-yellowLight text-benin-yellow flex items-center justify-center text-lg"><i class="fas fa-users"></i></div>
                    Mes Joueurs
                </h1>
                <p class="text-slate-500 mt-1">Gérez votre effectif et mettez à jour leurs profils.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('coach.joueurs.create') }}" class="bg-benin-green hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Ajouter un joueur
                </a>
            </div>
        </div>

        {{-- Messages flash --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-2xl p-4 flex items-start gap-3">
                <i class="fas fa-check-circle text-green-500 text-xl mt-0.5"></i>
                <p class="text-sm">{!! session('success') !!}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-2xl p-4 flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mt-0.5"></i>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 reveal">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 font-bold border-y border-slate-100">
                        <tr>
                            <th class="px-4 py-4">Joueur</th>
                            <th class="px-4 py-4 text-center">Âge</th>
                            <th class="px-4 py-4">Poste</th>
                            <th class="px-4 py-4">Statut</th>
                            <th class="px-4 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($joueurs as $joueur)
                        @php $j = is_object($joueur) ? $joueur : (object)$joueur; @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-4 font-bold text-slate-800 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full border-2 border-slate-100 bg-benin-yellowLight text-benin-yellow flex items-center justify-center font-bold text-lg overflow-hidden">
                                     <img src="https://ui-avatars.com/api/?name={{ urlencode($j->prenom ?? '' . ' ' . $j->nom ?? '') }}&background=fffbea&color=FCD116" alt="Avatar" class="w-full h-full object-cover">
                                </div> 
                                <div>
                                    <span class="text-base">{{ $j->prenom ?? '' }} {{ $j->nom ?? '' }}</span>
                                    <div class="text-xs text-slate-400 font-normal mt-0.5">E-mail: {{ $j->user->email ?? 'N/A' }} | ID: #{{ $j->id ?? '' }} | Pied {{ $j->pied_fort ?? 'Inconnu' }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center text-slate-500 font-medium">{{ $j->age ?? '-' }} ans</td>
                            <td class="px-4 py-4">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-semibold">{{ $j->poste ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-4">
                                @if(isset($j->statut) && $j->statut === 'validé')
                                    <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-check-circle"></i> Validé</span>
                                @elseif(isset($j->statut) && $j->statut === 'en_attente')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-clock"></i> En attente</span>
                                @else
                                    <span class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1"><i class="fas fa-pencil-alt"></i> Brouillon</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('coach.evaluations.create', $j->id ?? 1) }}" class="w-9 h-9 rounded-xl bg-benin-yellowLight text-benin-yellow flex items-center justify-center hover:bg-benin-yellow hover:text-white transition-all shadow-sm" title="Évaluer le joueur">
                                        <i class="fas fa-chart-line"></i>
                                    </a>
                                    <a href="{{ route('coach.joueurs.edit', $j->id ?? 1) }}" class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-slate-200 hover:text-benin-dark transition-all shadow-sm" title="Éditer le profil">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('joueur.public', $j->id ?? 1) }}" target="_blank" class="w-9 h-9 rounded-xl bg-benin-greenLight text-benin-green flex items-center justify-center hover:bg-benin-green hover:text-white transition-all shadow-sm" title="Voir le profil public">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">
                                <div class="text-4xl text-slate-300 mb-3"><i class="fas fa-user-slash"></i></div>
                                Aucun joueur n'a encore été ajouté à votre effectif.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
