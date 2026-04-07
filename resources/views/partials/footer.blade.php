<!-- FOOTER -->
<footer class="bg-benin-dark text-slate-400 pt-20 pb-10 rounded-t-[3rem] mt-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <div class="lg:col-span-1">
                <a href="{{ route('accueil') }}" class="text-2xl font-extrabold tracking-tight flex items-center gap-2 mb-6">
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-br from-benin-green to-benin-yellow flex items-center justify-center text-white text-sm">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <span class="text-white">SmartPlayer</span>
                </a>
                <p class="mb-6 text-sm leading-relaxed">La plateforme technologique de référence pour la détection
                    et l'évaluation des jeunes talents du football africain.</p>
                <div class="flex items-center gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-benin-green hover:text-white transition-colors"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-benin-green hover:text-white transition-colors"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-benin-green hover:text-white transition-colors"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Navigation</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('explorer') }}" class="hover:text-benin-yellow transition-colors">Découvrir les talents</a></li>
                    <li><a href="{{ route('pages.annuaire') }}" class="hover:text-benin-yellow transition-colors">Annuaire Académies</a></li>
                    <li><a href="{{ route('pages.methodologie') }}" class="hover:text-benin-yellow transition-colors">Notre méthodologie</a></li>
                    <li><a href="{{ route('pages.tarifs') }}" class="hover:text-benin-yellow transition-colors">Tarifs Recruteurs</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Entreprise</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('pages.a-propos') }}" class="hover:text-benin-yellow transition-colors">À propos de nous</a></li>
                    <li><a href="{{ route('pages.carrieres') }}" class="hover:text-benin-yellow transition-colors">Carrières</a></li>
                    <li><a href="{{ route('pages.blog') }}" class="hover:text-benin-yellow transition-colors">Blog & Actualités</a></li>
                    <li><a href="{{ route('pages.partenaires') }}" class="hover:text-benin-yellow transition-colors">Partenaires</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Contact</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-benin-green"></i>
                        <span>Hub Innovation<br>Cotonou, Bénin</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-benin-green"></i>
                        <span>hello@smartplayer.africa</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-benin-green"></i>
                        <span>+229 01 23 45 67 89</span>
                    </li>
                </ul>
            </div>

        </div>

        <div
            class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs">
            <p>&copy; 2025 SmartPlayer. Tous droits réservés.</p>
            <div class="flex gap-6">
                <a href="{{ route('pages.mentions-legales') }}" class="hover:text-white transition-colors">Mentions légales</a>
                <a href="{{ route('pages.politique-confidentialite') }}" class="hover:text-white transition-colors">Politique de confidentialité</a>
                <a href="{{ route('pages.cgu') }}" class="hover:text-white transition-colors">CGU</a>
            </div>
        </div>
    </div>
</footer>
