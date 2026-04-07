@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section id="accueil" class="relative pt-40 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-screen flex items-center">
    <!-- Blobs Background -->
    <div class="bg-blobs">
        <div class="blob bg-benin-yellow w-96 h-96 -top-20 -left-20"></div>
        <div class="blob bg-benin-green w-[500px] h-[500px] top-40 -right-40 opacity-20"></div>
        <div class="blob bg-benin-red w-72 h-72 bottom-0 left-1/3 opacity-10"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <!-- Text Content -->
        <div class="reveal">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-benin-greenLight text-benin-green font-semibold text-sm mb-6 border border-green-200">
                <span class="w-2 h-2 rounded-full bg-benin-green animate-pulse"></span>
                Plateforme N°1 de scouting en Afrique
            </div>
            <h1 class="text-5xl lg:text-7xl font-extrabold leading-[1.1] mb-6 tracking-tight text-benin-dark">
                Révélez <span class="text-gradient">l'étoile</span> du football africain.
            </h1>
            <p class="text-lg text-slate-600 mb-8 max-w-lg leading-relaxed">
                La première plateforme qui connecte académies locales, joueurs prometteurs et recruteurs
                internationaux. Détection transparente, valorisation sans frontière.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('explorer') }}"
                    class="bg-benin-green hover:bg-green-700 text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-green-500/30 transition-all hover:-translate-y-1 flex items-center gap-2">
                    <i class="fas fa-search"></i> Découvrir les talents
                </a>
                <a href="{{ route('register.academie') }}"
                    class="bg-white border-2 border-slate-200 hover:border-benin-yellow text-slate-700 px-8 py-4 rounded-full font-bold transition-all hover:-translate-y-1 hover:shadow-lg flex items-center gap-2">
                    <i class="fas fa-shield-halved text-benin-yellow"></i> Inscrire une académie
                </a>
            </div>

            <div class="mt-10 flex items-center gap-4 text-sm font-medium text-slate-500">
                <div class="flex -space-x-3">
                    <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 rounded-full border-2 border-white"
                        alt="Recruteur">
                    <img src="https://i.pravatar.cc/100?img=12" class="w-10 h-10 rounded-full border-2 border-white"
                        alt="Recruteur">
                    <img src="https://i.pravatar.cc/100?img=33" class="w-10 h-10 rounded-full border-2 border-white"
                        alt="Recruteur">
                    <div
                        class="w-10 h-10 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-xs">
                        +80</div>
                </div>
                <p>Recruteurs actifs ce mois-ci</p>
            </div>
        </div>

        <!-- Interactive Visual / Mockup -->
        <div class="relative reveal h-[500px] w-full hidden md:block">
            <!-- Main Image -->
            <div class="absolute inset-0 rounded-[2.5rem] overflow-hidden border-8 border-white shadow-2xl">
                <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=1000&auto=format&fit=crop"
                    alt="Joueur de football" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>

            <!-- Floating Stat Card 1 -->
            <div
                class="absolute top-10 -left-12 bg-white/90 backdrop-blur rounded-2xl p-4 shadow-floating animate-float border border-white">
                <div class="flex items-center gap-3">
                    <div
                        class="w-12 h-12 rounded-full bg-benin-yellowLight text-benin-yellow flex items-center justify-center text-xl">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase">Vitesse max</p>
                        <p class="text-xl font-extrabold text-slate-800">34.2 <span
                                class="text-sm font-normal">km/h</span></p>
                    </div>
                </div>
            </div>

            <!-- Floating Stat Card 2 -->
            <div
                class="absolute bottom-16 -right-8 bg-white/90 backdrop-blur rounded-2xl p-4 shadow-floating animate-float-delayed border border-white">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <p class="text-xs text-slate-500 font-bold uppercase mb-1">Potentiel IA</p>
                        <div class="flex gap-1 text-benin-yellow text-sm">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div
                        class="w-12 h-12 rounded-full border-4 border-benin-green flex items-center justify-center font-bold text-benin-green">
                        92%
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LOGO STRIP -->
<section class="border-y border-slate-200 bg-white py-8">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-center text-sm font-semibold text-slate-400 mb-6 uppercase tracking-wider">Ils utilisent
            notre technologie</p>
        <div class="flex flex-wrap justify-center items-center gap-12 opacity-60 grayscale">
            <h3 class="text-xl font-black">AJ COTONOU</h3>
            <h3 class="text-xl font-black font-serif">ASPAC FC</h3>
            <h3 class="text-xl font-black italic">CAVALLY ACADEMY</h3>
            <h3 class="text-xl font-black tracking-widest">LOTO-POPO</h3>
            <h3 class="text-xl font-black">DRAGONS FC</h3>
        </div>
    </div>
</section>

<!-- TALENTS DU MOMENT -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 reveal">
            <div class="max-w-2xl">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-1 bg-benin-yellow rounded-full"></div>
                    <h2 class="text-benin-yellow font-bold uppercase tracking-wider text-sm">Talents du Moment</h2>
                </div>
                <h3 class="text-4xl font-extrabold text-benin-dark mb-4">Les futures pépites prêtes pour le haut niveau</h3>
                <p class="text-slate-600 text-lg leading-relaxed">Découvrez les profils les plus prometteurs récemment validés par nos académies partenaires après une évaluation rigoureuse.</p>
            </div>
            <a href="{{ route('explorer') }}" class="inline-flex items-center gap-2 text-benin-green font-bold hover:gap-4 transition-all group shrink-0">
                Explorer tous les talents <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($derniersJoueurs as $joueur)
                <div class="reveal">
                    <x-player-card :joueur="(object)$joueur" />
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="text-5xl text-slate-200 mb-4"><i class="fas fa-user-clock"></i></div>
                    <p class="text-slate-500 font-medium italic">Les premières pépites arrivent très bientôt...</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ÉCOSYSTÈME À 3 NIVEAUX -->
<section id="ecosysteme" class="py-24 bg-slate-50 relative overflow-hidden">
    <!-- Blobs décoratifs -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-benin-green/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-benin-yellow/5 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div class="w-12 h-1 bg-benin-red rounded-full"></div>
                <h2 class="text-benin-red font-bold uppercase tracking-wider text-sm">Notre Écosystème</h2>
                <div class="w-12 h-1 bg-benin-green rounded-full"></div>
            </div>
            <h3 class="text-4xl font-extrabold text-benin-dark mb-4">Une chaîne de confiance structurée</h3>
            <p class="text-slate-600 text-lg">La fiabilité de nos données repose sur une architecture claire où chaque acteur a un rôle défini.</p>
        </div>

        <!-- Visualisation des 3 niveaux -->
        <div class="relative grid lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Ligne de connexion décorative -->
            <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 flow-line -translate-y-1/2 z-0 mx-auto"></div>

            <!-- NIVEAU 1 -->
            <div class="relative z-10 bg-white rounded-3xl p-8 shadow-xl border border-slate-100 hover:border-benin-green transition-all duration-300 reveal group">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-benin-green text-white rounded-2xl flex items-center justify-center font-extrabold text-xl border-4 border-slate-50 shadow-lg">
                    1
                </div>
                <div class="text-center mt-6 mb-5">
                    <div class="w-20 h-20 mx-auto bg-benin-greenLight text-benin-green rounded-2xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-benin-dark">L'Académie</h4>
                    <span class="inline-block px-4 py-1.5 bg-slate-100 text-slate-600 text-xs font-bold rounded-full mt-2 uppercase tracking-wider">Point d'entrée</span>
                </div>
                <p class="text-slate-600 text-center leading-relaxed">
                    L'<strong class="text-benin-green">administrateur de l'académie</strong> s'inscrit et structure son organisation. Il crée les comptes sécurisés pour ses coachs et définit les permissions.
                </p>
                <div class="mt-6 pt-4 border-t border-dashed border-slate-200 text-center">
                    <span class="text-xs font-semibold text-benin-green"><i class="fas fa-check-circle mr-1"></i> 100% des données certifiées à la source</span>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('register.academie') }}" class="text-sm font-semibold text-benin-green hover:underline">S'inscrire comme académie</a>
                </div>
            </div>

            <!-- NIVEAU 2 -->
            <div class="relative z-10 bg-white rounded-3xl p-8 shadow-xl border border-slate-100 hover:border-benin-yellow transition-all duration-300 reveal group lg:-translate-y-4">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-benin-yellow text-benin-dark rounded-2xl flex items-center justify-center font-extrabold text-xl border-4 border-slate-50 shadow-lg">
                    2
                </div>
                <div class="text-center mt-6 mb-5">
                    <div class="w-20 h-20 mx-auto bg-benin-yellowLight text-benin-yellow rounded-2xl flex items-center justify-center text-3xl mb-4 relative group-hover:scale-110 transition-transform">
                        <i class="fas fa-whistle"></i>
                        <i class="fas fa-running absolute -bottom-1 -right-1 text-base bg-white rounded-full p-1 shadow-sm"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-benin-dark">Coachs & Joueurs</h4>
                    <span class="inline-block px-4 py-1.5 bg-slate-100 text-slate-600 text-xs font-bold rounded-full mt-2 uppercase tracking-wider">Valorisation</span>
                </div>
                <p class="text-slate-600 text-center leading-relaxed">
                    Les <strong class="text-benin-yellow">coachs</strong> enregistrent les joueurs et initient leurs profils. Les <strong class="text-benin-yellow">joueurs</strong> accèdent à leur espace personnel pour enrichir leur parcours.
                </p>
                <div class="mt-6 pt-4 border-t border-dashed border-slate-200 text-center">
                    <span class="text-xs font-semibold text-benin-yellow"><i class="fas fa-check-circle mr-1"></i> Collaboration joueur/club</span>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-benin-yellow hover:underline">Accès Joueur/Coach</a>
                </div>
            </div>

            <!-- NIVEAU 3 -->
            <div class="relative z-10 bg-white rounded-3xl p-8 shadow-xl border border-slate-100 hover:border-benin-red transition-all duration-300 reveal group">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-benin-red text-white rounded-2xl flex items-center justify-center font-extrabold text-xl border-4 border-slate-50 shadow-lg">
                    3
                </div>
                <div class="text-center mt-6 mb-5">
                    <div class="w-20 h-20 mx-auto bg-benin-redLight text-benin-red rounded-2xl flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-search-dollar"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-benin-dark">Recruteurs & Clubs</h4>
                    <span class="inline-block px-4 py-1.5 bg-slate-100 text-slate-600 text-xs font-bold rounded-full mt-2 uppercase tracking-wider">Exploitation</span>
                </div>
                <p class="text-slate-600 text-center leading-relaxed">
                    <strong class="text-benin-red">Accès authentifié</strong> pour les fonctionnalités avancées : analyse approfondie, favoris, et contact direct avec l'académie.
                </p>
                <div class="mt-6 pt-4 border-t border-dashed border-slate-200 text-center">
                    <span class="text-xs font-semibold text-benin-red"><i class="fas fa-check-circle mr-1"></i> Mise en relation sécurisée</span>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('register.recruteur') }}" class="text-sm font-semibold text-benin-red hover:underline">Accès Recruteur</a>
                </div>
            </div>
        </div>

        <!-- Message récapitulatif -->
        <div class="mt-16 text-center max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-sm border border-slate-100 reveal">
            <p class="text-slate-700">
                <i class="fas fa-quote-left text-benin-green opacity-30 mr-2"></i>
                <span class="font-medium">Un système où l'académie garde le contrôle, le joueur valorise son talent, et le recruteur accède à des données fiables.</span>
                <i class="fas fa-quote-right text-benin-green opacity-30 ml-2"></i>
            </p>
        </div>
    </div>
</section>

<!-- QUI SOMMES NOUS -->
<section id="apropos" class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="reveal relative">
            <div class="absolute -inset-4 bg-benin-yellow/20 rounded-[3rem] transform -rotate-3"></div>
            <!-- L'image de l'entraînement académie, ici le user fournissait EntrainementAcademic.avif -->
            <img src="{{ asset('EntrainementAcademic.avif') }}"
                alt="Entrainement académie"
                class="relative rounded-[2.5rem] shadow-xl w-full h-[450px] object-cover border-4 border-white"
                onerror="this.src='https://images.unsplash.com/photo-1518605368461-1ee11ed5ccb5?q=80&w=1000&auto=format&fit=crop'">

            <div class="absolute -bottom-8 -right-8 bg-benin-green text-white p-6 rounded-3xl shadow-2xl">
                <i class="fas fa-quote-left text-3xl opacity-50 mb-2"></i>
                <p class="font-medium">Rendre chaque talent<br>visible, partout.</p>
            </div>
        </div>

        <div class="reveal">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-1 bg-benin-red rounded-full"></div>
                <h2 class="text-benin-red font-bold uppercase tracking-wider text-sm">Notre Mission</h2>
            </div>
            <h3 class="text-4xl font-extrabold mb-6 text-benin-dark">Rééquilibrer la détection dans le monde du
                football.</h3>
            <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                <strong>SmartPlayer</strong> est une startup béninoise née d'un constat simple : l'Afrique
                regorge de talents exceptionnels, mais le manque de structuration des données limite leur
                visibilité.
            </p>
            <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                Nous donnons aux académies locales des outils professionnels pour évaluer leurs joueurs, et offrons
                aux recruteurs européens et africains une base de données qualifiée, vérifiée et mise à jour en
                temps réel.
            </p>

            <ul class="space-y-4">
                <li class="flex items-center gap-4 text-slate-700 font-medium">
                    <div
                        class="w-8 h-8 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center">
                        <i class="fas fa-check"></i></div>
                    Données certifiées par nos experts locaux
                </li>
                <li class="flex items-center gap-4 text-slate-700 font-medium">
                    <div
                        class="w-8 h-8 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center">
                        <i class="fas fa-check"></i></div>
                    Outils d'analyse vidéo intégrés
                </li>
                <li class="flex items-center gap-4 text-slate-700 font-medium">
                    <div
                        class="w-8 h-8 rounded-full bg-benin-greenLight text-benin-green flex items-center justify-center">
                        <i class="fas fa-check"></i></div>
                    Mise en relation directe et sécurisée
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- STATS COUNTER -->
<section class="bg-benin-dark py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"
        style="background-image: radial-gradient(#FCD116 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
            <div class="reveal">
                <p class="text-5xl font-black text-white mb-2"><span class="counter" data-target="135">0</span>+</p>
                <p class="text-slate-400 font-medium uppercase tracking-wider text-sm">Académies</p>
            </div>
            <div class="reveal">
                <p class="text-5xl font-black text-benin-yellow mb-2"><span class="counter"
                        data-target="2400">0</span></p>
                <p class="text-slate-400 font-medium uppercase tracking-wider text-sm">Joueurs suivis</p>
            </div>
            <div class="reveal">
                <p class="text-5xl font-black text-benin-green mb-2"><span class="counter" data-target="85">0</span>
                </p>
                <p class="text-slate-400 font-medium uppercase tracking-wider text-sm">Recruteurs</p>
            </div>
            <div class="reveal">
                <p class="text-5xl font-black text-benin-red mb-2"><span class="counter" data-target="12">0</span>
                </p>
                <p class="text-slate-400 font-medium uppercase tracking-wider text-sm">Pays couverts</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section id="services" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <h2 class="text-4xl font-extrabold text-benin-dark mb-4">Un écosystème complet</h2>
            <p class="text-slate-600 text-lg">Tout ce dont vous avez besoin pour gérer, évaluer et recruter les
                futurs champions.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div
                class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal">
                <div
                    class="w-16 h-16 rounded-2xl bg-benin-yellowLight text-benin-yellow flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-id-card"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Profils Détaillés</h3>
                <p class="text-slate-600 leading-relaxed">CV sportif complet, mensurations, données techniques,
                    tactiques et biométriques mises à jour régulièrement.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal"
                style="transition-delay: 100ms;">
                <div
                    class="w-16 h-16 rounded-2xl bg-benin-greenLight text-benin-green flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Analyse Vidéo</h3>
                <p class="text-slate-600 leading-relaxed">Intégration de highlights et matchs complets. Clips
                    séquencés par actions (buts, passes, défense).</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal"
                style="transition-delay: 200ms;">
                <div
                    class="w-16 h-16 rounded-2xl bg-benin-redLight text-benin-red flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Suivi Performance</h3>
                <p class="text-slate-600 leading-relaxed">Tableaux de bord pour les coachs : suivez l'évolution de
                    vos joueurs sur la saison via nos grilles d'évaluation.</p>
            </div>
            <!-- Card 4 -->
            <div
                class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal">
                <div
                    class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-700 flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-building-user"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Vitrines Académies</h3>
                <p class="text-slate-600 leading-relaxed">Page publique dédiée pour chaque centre de formation afin
                    de présenter son histoire, son staff et ses effectifs.</p>
            </div>
            <!-- Card 5 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal"
                style="transition-delay: 100ms;">
                <div
                    class="w-16 h-16 rounded-2xl bg-benin-yellowLight text-benin-yellow flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-filter"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Moteur de Recherche</h3>
                <p class="text-slate-600 leading-relaxed">Filtres multicritères avancés pour les recruteurs (âge,
                    pied fort, poste, note tactique, disponibilité).</p>
            </div>
            <!-- Card 6 -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 hover:border-benin-green hover:-translate-y-2 transition-all duration-300 group reveal"
                style="transition-delay: 200ms;">
                <div
                    class="w-16 h-16 rounded-2xl bg-benin-greenLight text-benin-green flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">Messagerie Sécurisée</h3>
                <p class="text-slate-600 leading-relaxed">Contact direct et transparent entre le club acquéreur et
                    l'académie formatrice. Zéro intermédiaire occulte.</p>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS CAROUSEL -->
<section class="py-20 bg-slate-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 mb-12 reveal">
        <h2 class="text-3xl font-extrabold text-center">Ils nous font confiance</h2>
    </div>

    <div class="w-full relative">
        <!-- Gradient masks for smooth fade effect -->
        <div
            class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-slate-100 to-transparent z-10 pointer-events-none">
        </div>
        <div
            class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-slate-100 to-transparent z-10 pointer-events-none">
        </div>

        <div
            class="flex animate-scroll w-[200%] md:w-[150%] gap-6 px-6 carousel-track cursor-grab active:cursor-grabbing hover:[animation-play-state:paused]">
            <!-- Cards generation (Duplicated for infinite effect) -->
            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-green">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i></div>
                <p class="text-slate-600 italic mb-6">"Grâce à SmartPlayer, deux de nos milieux de terrain sont
                    actuellement à l'essai dans un club partenaire en France. La visibilité est réelle."</p>
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                        AD</div>
                    <div>
                        <p class="font-bold text-slate-800">Acad. A. Dossou</p>
                        <p class="text-xs text-slate-500">Directeur Sportif</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-red">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star-half-alt"></i></div>
                <p class="text-slate-600 italic mb-6">"Interface ultra claire. Je peux scouter des jeunes au Bénin
                    et au Togo directement depuis mon bureau à Paris avec des datas fiables."</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 rounded-full" alt="Avatar">
                    <div>
                        <p class="font-bold text-slate-800">Marc T.</p>
                        <p class="text-xs text-slate-500">Recruteur, Ligue 2 (FR)</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-yellow">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i></div>
                <p class="text-slate-600 italic mb-6">"Outil indispensable. Nous avons pu digitaliser tout le suivi
                    de nos catégories U15 à U19. Fini les fiches d'évaluation papier."</p>
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                        AJ</div>
                    <div>
                        <p class="font-bold text-slate-800">AJ Cotonou</p>
                        <p class="text-xs text-slate-500">Coach U17</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-dark">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="far fa-star"></i></div>
                <p class="text-slate-600 italic mb-6">"Enfin une vitrine professionnelle pour nos jeunes pépites du
                    Nord. La plateforme est facile à utiliser même sur mobile."</p>
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                        AP</div>
                    <div>
                        <p class="font-bold text-slate-800">Académie de Parakou</p>
                        <p class="text-xs text-slate-500">Fondateur</p>
                    </div>
                </div>
            </div>

            <!-- Duplication for seamless loop -->
            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-green">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i></div>
                <p class="text-slate-600 italic mb-6">"Grâce à SmartPlayer, deux de nos milieux de terrain sont
                    actuellement à l'essai dans un club partenaire en France. La visibilité est réelle."</p>
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500">
                        AD</div>
                    <div>
                        <p class="font-bold text-slate-800">Acad. A. Dossou</p>
                        <p class="text-xs text-slate-500">Directeur Sportif</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200 w-[350px] shrink-0 border-t-4 border-t-benin-red">
                <div class="flex items-center gap-1 text-benin-yellow mb-4 text-sm"><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star-half-alt"></i></div>
                <p class="text-slate-600 italic mb-6">"Interface ultra claire. Je peux scouter des jeunes au Bénin
                    et au Togo directement depuis mon bureau à Paris avec des datas fiables."</p>
                <div class="flex items-center gap-4">
                    <img src="https://i.pravatar.cc/100?img=11" class="w-10 h-10 rounded-full" alt="Avatar">
                    <div>
                        <p class="font-bold text-slate-800">Marc T.</p>
                        <p class="text-xs text-slate-500">Recruteur, Ligue 2 (FR)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA & CONTACT SECTION -->
<section class="py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16">

        <!-- CTA Block -->
        <div
            class="bg-gradient-to-br from-benin-green to-[#004d2e] rounded-[3rem] p-12 text-white shadow-2xl relative overflow-hidden reveal">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-y-1/2 translate-x-1/3">
            </div>
            <div
                class="absolute bottom-0 left-0 w-48 h-48 bg-benin-yellow opacity-10 rounded-full translate-y-1/2 -translate-x-1/4">
            </div>

            <div class="relative z-10">
                <h2 class="text-4xl font-extrabold mb-4">Prêt à propulser vos talents ?</h2>
                <p class="text-green-100 text-lg mb-8 leading-relaxed">
                    Ne laissez plus vos pépites dans l'ombre. Rejoignez le réseau SmartPlayer, structurez vos
                    données et ouvrez les portes du professionnalisme à vos joueurs.
                </p>
                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-benin-yellow"></i>
                        Inscription académie 100% gratuite</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-benin-yellow"></i>
                        Support dédié 7j/7</li>
                    <li class="flex items-center gap-3"><i class="fas fa-check-circle text-benin-yellow"></i> Mise
                        en avant prioritaire les 30 premiers jours</li>
                </ul>
                <a href="{{ route('register.academie') }}"
                    class="block bg-benin-yellow hover:bg-yellow-400 text-benin-dark px-8 py-4 rounded-full font-bold shadow-xl transition-all hover:-translate-y-1 w-full sm:w-auto text-center">
                    Créer mon espace académie <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="reveal">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-benin-dark mb-2">Une question ?</h2>
                <p class="text-slate-600">Notre équipe basée à Cotonou vous répond en moins de 24h.</p>
            </div>

            <form class="space-y-5" onsubmit="event.preventDefault(); alert('Message envoyé avec succès !');">
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
                        <input type="text"
                            class="w-full px-5 py-4 rounded-2xl bg-white border border-slate-200 focus:border-benin-green focus:ring-4 focus:ring-green-500/10 outline-none transition-all"
                            placeholder="John Doe" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Rôle</label>
                        <select
                            class="w-full px-5 py-4 rounded-2xl bg-white border border-slate-200 focus:border-benin-green focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-500">
                            <option>Académie / Club</option>
                            <option>Recruteur / Agent</option>
                            <option>Joueur</option>
                            <option>Autre</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email"
                        class="w-full px-5 py-4 rounded-2xl bg-white border border-slate-200 focus:border-benin-green focus:ring-4 focus:ring-green-500/10 outline-none transition-all"
                        placeholder="contact@academie.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Message</label>
                    <textarea rows="4"
                        class="w-full px-5 py-4 rounded-2xl bg-white border border-slate-200 focus:border-benin-green focus:ring-4 focus:ring-green-500/10 outline-none transition-all resize-none"
                        placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-benin-dark hover:bg-black text-white px-8 py-4 rounded-2xl font-bold shadow-xl transition-all hover:-translate-y-1">
                    Envoyer le message
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
