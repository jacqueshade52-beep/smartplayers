@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('coach.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de dashboard</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center text-lg"><i class="fas fa-check-double"></i></div>
                    Validations en attente
                </h1>
                <p class="text-slate-500 mt-1">Vérifiez les profils avant leur publication sur le réseau.</p>
            </div>
        </div>

        @if($joueurs->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
            @foreach($joueurs as $joueur)
            @php $j = is_object($joueur) ? $joueur : (object)$joueur; @endphp
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 hover:border-benin-green transition-all group">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4 mb-4">
                    <div class="w-16 h-16 rounded-full border-2 border-slate-100 bg-benin-yellowLight text-benin-yellow flex items-center justify-center font-bold text-xl overflow-hidden shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($j->prenom ?? '' . ' ' . $j->nom ?? '') }}&background=fffbea&color=FCD116" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">{{ $j->prenom ?? '' }} {{ $j->nom ?? '' }}</h3>
                        <p class="text-sm font-semibold text-slate-500">{{ $j->poste ?? 'Poste inconnu' }}</p>
                        <span class="inline-block mt-1 bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">En attente<i class="fas fa-hourglass-half ml-1"></i></span>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500"><i class="fas fa-calendar-alt w-5 text-center"></i> Âge</span>
                        <span class="font-bold text-slate-800">{{ $j->age ?? '-' }} ans</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500"><i class="fas fa-shoe-prints w-5 text-center text-benin-yellow"></i> Pied fort</span>
                        <span class="font-bold text-slate-800">{{ $j->pied_fort ?? '-' }}</span>
                    </div>
                    <div class="pt-3 border-t border-slate-100 mt-3">
                        <div class="text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wide">Résumé notes /5</div>
                        <div class="flex gap-2 justify-between">
                            <span class="bg-green-50 text-benin-green font-bold text-xs px-2 py-1 rounded">Tech: {{ $j->note_technique ?? 'N/A' }}</span>
                            <span class="bg-yellow-50 text-yellow-600 font-bold text-xs px-2 py-1 rounded">Tac: {{ $j->note_tactique ?? 'N/A' }}</span>
                            <span class="bg-red-50 text-red-500 font-bold text-xs px-2 py-1 rounded">Phy: {{ $j->note_physique ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <form action="{{ route('coach.joueurs.reject', $j->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 rounded-xl font-bold text-red-600 bg-red-50 hover:bg-red-100 transition-colors border border-transparent hover:border-red-200">
                            <i class="fas fa-undo mr-1"></i> Renvoyer
                        </button>
                    </form>
                    <form action="{{ route('coach.joueurs.validate', $j->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 transition-colors shadow-lg shadow-green-500/20">
                            <i class="fas fa-check-double mr-1"></i> Valider
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-[2rem] p-12 text-center border border-slate-100 shadow-sm reveal">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center text-benin-green mx-auto mb-6 text-3xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Tout est à jour !</h2>
            <p class="text-slate-500 max-w-md mx-auto">Vous n'avez aucun joueur en attente de validation pour le moment. Félicitations pour votre efficacité.</p>
            <a href="{{ route('coach.joueurs') }}" class="inline-block mt-8 bg-benin-dark text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition-all">Consulter l'effectif actuel</a>
        </div>
        @endif
    </div>
</div>
@endsection
