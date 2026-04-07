@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 pb-6 border-b border-slate-200">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('academie.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de dashboard</a>
                <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center text-lg"><i class="fas fa-whistle"></i></div>
                    Équipe d'Encadrement
                </h1>
                <p class="text-slate-500 mt-1">Gérez les coachs qui s'occupent de la formation de vos talents.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('academie.coachs.create') }}" class="bg-benin-green hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Ajouter un coach
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 reveal">
            @forelse($coachs as $coach)
            @php $c = is_object($coach) ? $coach : (object)$coach; @endphp
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 hover:border-benin-green transition-all group relative overflow-hidden">
                <div class="absolute top-4 right-4 flex gap-2">
                    <a href="{{ route('academie.coachs.edit', $c->id) }}" class="text-slate-300 hover:text-benin-green transition-colors" title="Modifier"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('academie.coachs.delete', $c->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce coach ? Cette action supprimera également son compte utilisateur.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-slate-300 hover:text-benin-red transition-colors" title="Supprimer le coach"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
                
                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-20 h-20 rounded-full border-4 border-slate-50 bg-benin-greenLight text-benin-green flex items-center justify-center font-bold text-2xl overflow-hidden shadow-sm mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(($c->prenom ?? '') . ' ' . ($c->nom ?? '')) }}&background=e6f3ed&color=008751" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-xl text-slate-800">{{ $c->prenom ?? '' }} {{ $c->nom ?? '' }}</h3>
                    <p class="text-sm text-slate-500 font-medium">Coach {{ $c->categorie ?? 'Principal' }}</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-4 flex justify-between items-center text-sm border border-slate-100">
                    <div class="text-center">
                        <span class="block text-slate-400 font-semibold mb-1">Joueurs</span>
                        <span class="font-black text-slate-700 text-lg">{{ $c->joueurs_count ?? 0 }}</span>
                    </div>
                    <div class="h-8 w-px bg-slate-200"></div>
                    <div class="text-center">
                        <span class="block text-slate-400 font-semibold mb-1">Catégorie</span>
                        <span class="font-bold text-benin-green text-sm">{{ $c->categorie ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 flex justify-center">
                    <a href="{{ route('academie.coachs.edit', $c->id) }}" class="text-xs font-bold text-benin-green hover:underline">Modifier le profil</a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-[2rem] p-12 text-center border border-slate-100 shadow-sm">
                <div class="text-4xl text-slate-300 mb-4"><i class="fas fa-users-slash"></i></div>
                <p class="text-slate-500 font-medium">Aucun coach n'est rattaché à votre académie pour le moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
