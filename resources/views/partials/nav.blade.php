<!-- NAVBAR -->
<nav class="fixed top-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] max-w-7xl z-50 transition-all duration-300">
    <div class="glass-nav rounded-full px-6 py-4 flex justify-between items-center shadow-glass">
        <!-- Logo -->
        <a href="{{ route('accueil') }}" class="text-2xl font-extrabold tracking-tight flex items-center gap-2">
            <div
                class="w-8 h-8 rounded-full bg-gradient-to-br from-benin-green to-benin-yellow flex items-center justify-center text-white text-sm">
                <i class="fas fa-futbol"></i>
            </div>
            <span class="text-gradient">SmartPlayer</span>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8 font-medium text-sm">
            @php $role = session('role'); @endphp

            @if(!$role)
                <a href="{{ route('accueil') }}#accueil" class="hover:text-benin-green transition-colors">Accueil</a>
                <a href="{{ route('accueil') }}#ecosysteme" class="hover:text-benin-green transition-colors">Écosystème</a>
                <a href="{{ route('accueil') }}#services" class="hover:text-benin-green transition-colors">Services</a>
                <a href="{{ route('accueil') }}#apropos" class="hover:text-benin-green transition-colors">À propos</a>
                <a href="{{ route('explorer') }}" class="hover:text-benin-green transition-colors font-bold">Explorer</a>
            @elseif($role === 'academie')
                <a href="{{ route('academie.dashboard') }}" class="hover:text-benin-green transition-colors">Dashboard</a>
                <a href="{{ route('academie.coachs') }}" class="hover:text-benin-green transition-colors">Coachs</a>
                <a href="{{ route('academie.joueurs') }}" class="hover:text-benin-green transition-colors">Joueurs</a>
                <a href="{{ route('messages.index') }}" class="hover:text-benin-green transition-colors">Messages</a>
                <a href="{{ route('academie.profil') }}" class="hover:text-benin-green transition-colors">Profil</a>
            @elseif($role === 'coach')
                <a href="{{ route('coach.dashboard') }}" class="hover:text-benin-green transition-colors">Dashboard</a>
                <a href="{{ route('coach.joueurs') }}" class="hover:text-benin-green transition-colors">Mes joueurs</a>
                <a href="{{ route('coach.validations') }}" class="hover:text-benin-green transition-colors">Validations</a>
            @elseif($role === 'joueur')
                <a href="{{ route('joueur.dashboard') }}" class="hover:text-benin-green transition-colors">Dashboard</a>
                <a href="{{ route('joueur.profil') }}" class="hover:text-benin-green transition-colors">Mon profil</a>
                <a href="{{ route('joueur.videos') }}" class="hover:text-benin-green transition-colors">Vidéos</a>
                <a href="{{ route('joueur.stats') }}" class="hover:text-benin-green transition-colors">Statistiques</a>
            @elseif($role === 'recruteur')
                <a href="{{ route('recruteur.dashboard') }}" class="hover:text-benin-green transition-colors">Dashboard</a>
                <a href="{{ route('recherche') }}" class="hover:text-benin-green transition-colors">Recherche</a>
                <a href="{{ route('recruteur.favoris') }}" class="hover:text-benin-green transition-colors">Favoris</a>
                <a href="{{ route('recruteur.messages') }}" class="hover:text-benin-green transition-colors">Messages</a>
            @endif
        </div>

        <!-- Actions Desktop -->
        <div class="hidden md:flex items-center gap-4">
            @if(!$role)
                <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-benin-green transition-colors">Se connecter</a>
                <a href="{{ route('register.academie') }}"
                    class="bg-benin-red hover:bg-red-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg shadow-red-500/30 transition-all hover:-translate-y-0.5">
                    Créer un compte
                </a>
            @else
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-bold text-benin-green bg-benin-greenLight px-3 py-1 rounded-full uppercase">{{ $role }}</span>
                    
                    @php $user = auth()->user(); @endphp
                    <div class="w-10 h-10 rounded-full border-2 border-white shadow-sm overflow-hidden bg-slate-100 flex items-center justify-center">
                        @if($user && $user->photo_profil)
                            <img src="{{ asset('storage/' . $user->photo_profil) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-slate-300"></i>
                        @endif
                    </div>

                    <a href="{{ route('logout') }}" class="text-sm font-semibold text-slate-500 hover:text-red-500 transition-colors ml-1"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            @endif
        </div>

        <!-- Mobile Toggle -->
        <button id="mobile-menu-btn" class="md:hidden text-slate-700 text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu"
        class="hidden absolute top-full mt-4 left-0 w-full glass-nav rounded-3xl p-6 flex flex-col gap-4 shadow-xl border border-white/40">
        @if(!$role)
            <a href="{{ route('accueil') }}#accueil" class="font-medium text-lg border-b border-slate-100 pb-2">Accueil</a>
            <a href="{{ route('accueil') }}#ecosysteme" class="font-medium text-lg border-b border-slate-100 pb-2">Écosystème</a>
            <a href="{{ route('accueil') }}#services" class="font-medium text-lg border-b border-slate-100 pb-2">Services</a>
            <a href="{{ route('accueil') }}#apropos" class="font-medium text-lg border-b border-slate-100 pb-2">À propos</a>
            <a href="{{ route('explorer') }}" class="font-medium text-lg border-b border-slate-100 pb-2 text-benin-green">Explorer</a>
            <div class="flex flex-col gap-3 mt-2">
                <a href="{{ route('login') }}" class="text-center font-semibold py-3 bg-slate-100 rounded-xl">Se connecter</a>
                <a href="{{ route('register.academie') }}"
                    class="text-center font-semibold py-3 bg-benin-green text-white rounded-xl shadow-lg shadow-green-500/30">Créer un compte</a>
            </div>
        @else
            <!-- Liens mobiles connectés selon rôle (simplifié pour l'exemple) -->
            <a href="#" class="font-medium text-lg border-b border-slate-100 pb-2">Mon Dashboard</a>
            <div class="flex flex-col gap-3 mt-2">
                <a href="{{ route('logout') }}" class="text-center font-semibold py-3 bg-red-50 text-red-500 rounded-xl">Déconnexion</a>
            </div>
        @endif
    </div>
</nav>
