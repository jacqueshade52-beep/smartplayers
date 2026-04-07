@props(['joueur'])

<div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-1 transition-all duration-300 group">
    <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-benin-green flex items-center justify-center bg-slate-100">
                @if($joueur->user && $joueur->user->photo_profil)
                    <img src="{{ asset('storage/' . $joueur->user->photo_profil) }}" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($joueur->prenom . ' ' . $joueur->nom) }}&background=e6f3ed&color=008751" alt="{{ $joueur->nom }}" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-lg">{{ $joueur->prenom }} {{ $joueur->nom }}</h4>
                <p class="text-xs font-semibold text-slate-500 uppercase">{{ $joueur->poste ?? 'Joueur' }}</p>
            </div>
        </div>
        <div class="flex flex-col items-end gap-2">
            @auth
                @if(auth()->user()->role === 'recruteur')
                    <form action="{{ route('recruteur.favoris.toggle', $joueur->id) }}" method="POST">
                        @csrf
                        @php $isFav = auth()->user()->recruteur->favoris()->where('joueur_id', $joueur->id)->exists(); @endphp
                        <button type="submit" class="w-8 h-8 rounded-full {{ $isFav ? 'bg-red-50 text-red-500 border-red-100' : 'bg-slate-50 text-slate-300 border-slate-100' }} border flex items-center justify-center hover:scale-110 transition-transform shadow-sm" title="{{ $isFav ? 'Retirer des favoris' : 'Ajouter aux favoris' }}">
                            <i class="{{ $isFav ? 'fas' : 'far' }} fa-heart text-xs"></i>
                        </button>
                    </form>
                @endif
            @endauth
            <div class="flex gap-1 text-benin-yellow text-xs">
                <i class="fas fa-star text-benin-yellow"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
        <div class="bg-slate-50 p-3 rounded-2xl flex items-center gap-2">
            <i class="fas fa-calendar-alt text-benin-green opacity-70"></i>
            <div>
                <p class="text-xs text-slate-400">Âge</p>
                <p class="font-bold text-slate-700">{{ $joueur->age ?? 'N/A' }}{{ $joueur->age ? ' ans' : '' }}</p>
            </div>
        </div>
        <div class="bg-slate-50 p-3 rounded-2xl flex items-center gap-2">
            <i class="fas fa-shoe-prints text-benin-yellow opacity-70"></i>
            <div>
                <p class="text-xs text-slate-400">Pied fort</p>
                <p class="font-bold text-slate-700">{{ $joueur->pied_fort }}</p>
            </div>
        </div>
    </div>
    
    <p class="text-slate-600 text-sm mb-6 line-clamp-2">
        {{ $joueur->description }}
    </p>
    
    <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
        <span class="text-xs font-semibold px-3 py-1 bg-benin-greenLight text-benin-green rounded-full">
            {{ $joueur->club }}
        </span>
        <a href="{{ route('joueur.public', $joueur->id) }}" class="text-sm font-bold border border-slate-200 px-4 py-2 rounded-full hover:bg-slate-50 hover:border-benin-green text-slate-700 transition-colors">
            Voir profil
        </a>
    </div>
</div>
