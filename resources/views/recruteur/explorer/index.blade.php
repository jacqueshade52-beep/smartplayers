@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-8 pb-4 border-b border-slate-200">
            <div>
                <h1 class="text-4xl font-extrabold text-benin-dark mb-2">Explorer les Talents</h1>
                <p class="text-slate-500">Découvrez les profils validés par les académies partenaires.</p>
            </div>
            
            <form action="{{ route('recherche') }}" class="flex gap-2">
                <input type="text" name="q" placeholder="Rechercher un joueur..." class="px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-benin-green text-sm bg-white shadow-sm w-64">
                <button type="submit" class="bg-benin-dark text-white px-4 py-2 rounded-xl hover:bg-black transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Filtres Mock -->
        <div class="flex gap-4 mb-8 overflow-x-auto pb-4 no-scrollbar">
            <a href="{{ route('explorer') }}" class="whitespace-nowrap {{ !request('poste') ? 'bg-benin-green text-white shadow-green-500/20 shadow-md' : 'bg-white text-slate-600 border border-slate-200' }} px-6 py-2 rounded-full text-sm font-semibold transition-all">Tous</a>
            <a href="{{ route('recherche', ['poste' => 'Attaquant']) }}" class="whitespace-nowrap {{ request('poste') == 'Attaquant' ? 'bg-benin-green text-white shadow-green-500/20 shadow-md' : 'bg-white text-slate-600 border border-slate-200' }} px-6 py-2 rounded-full text-sm font-semibold hover:border-benin-green transition-all">Attaquants</a>
            <a href="{{ route('recherche', ['poste' => 'Milieu']) }}" class="whitespace-nowrap {{ request('poste') == 'Milieu' ? 'bg-benin-green text-white shadow-green-500/20 shadow-md' : 'bg-white text-slate-600 border border-slate-200' }} px-6 py-2 rounded-full text-sm font-semibold hover:border-benin-green transition-all">Milieux</a>
            <a href="{{ route('recherche', ['poste' => 'Défenseur']) }}" class="whitespace-nowrap {{ request('poste') == 'Défenseur' ? 'bg-benin-green text-white shadow-green-500/20 shadow-md' : 'bg-white text-slate-600 border border-slate-200' }} px-6 py-2 rounded-full text-sm font-semibold hover:border-benin-green transition-all">Défenseurs</a>
            <a href="{{ route('recherche', ['poste' => 'Gardien']) }}" class="whitespace-nowrap {{ request('poste') == 'Gardien' ? 'bg-benin-green text-white shadow-green-500/20 shadow-md' : 'bg-white text-slate-600 border border-slate-200' }} px-6 py-2 rounded-full text-sm font-semibold hover:border-benin-green transition-all">Gardiens</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($joueurs as $joueur)
                <x-player-card :joueur="$joueur" />
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4 text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <p class="text-slate-500 font-medium">Aucun talent trouvé avec ces critères.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12 flex justify-center">
            <div class="flex gap-2">
                <button class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
                <button class="w-10 h-10 rounded-xl bg-benin-green text-white flex items-center justify-center shadow-md">1</button>
                <button class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200 hover:border-benin-green flex items-center justify-center transition-colors">2</button>
                <button class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200 hover:border-benin-green flex items-center justify-center transition-colors">3</button>
                <button class="w-10 h-10 rounded-xl bg-white text-slate-600 border border-slate-200 hover:border-benin-green flex items-center justify-center transition-colors"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection
