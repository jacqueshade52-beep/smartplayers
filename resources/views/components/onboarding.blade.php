@if(auth()->check() && !auth()->user()->has_onboarded)
<div id="onboarding-overlay" class="fixed inset-0 z-[100] bg-slate-900/80 backdrop-blur-md flex items-center justify-center p-6 overflow-hidden">
    <div class="relative max-w-2xl w-full bg-white rounded-[3rem] shadow-2xl p-10 md:p-16 text-center reveal animate-in fade-in zoom-in duration-500">
        <!-- Close button -->
        <button onclick="dismissOnboarding()" class="absolute top-8 right-8 text-slate-300 hover:text-slate-600 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>

        <!-- Progress bar -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-slate-100 rounded-t-[3rem] overflow-hidden">
            <div id="onboarding-progress" class="h-full bg-benin-green transition-all duration-500" style="width: 33%"></div>
        </div>

        <div id="onboarding-steps">
            <!-- Step 1: Welcome -->
            <div class="onboarding-step" data-step="1">
                <div class="w-24 h-24 bg-benin-greenLight rounded-[2rem] flex items-center justify-center text-benin-green text-4xl mx-auto mb-8 animate-bounce">
                    <i class="fas fa-hand-wave"></i>
                </div>
                <h2 class="text-4xl font-black text-benin-dark mb-4">Bienvenue, {{ auth()->user()->name }} !</h2>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                    Nous sommes ravis de vous compter parmi nous. SmartPlayer est l'écosystème où le talent rencontre les opportunités. Prenons 30 secondes pour faire le tour !
                </p>
                <button onclick="nextStep()" class="bg-benin-dark text-white px-10 py-4 rounded-2xl font-black hover:bg-black transition-all shadow-xl shadow-slate-900/20">
                    C'est parti ! <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>

            <!-- Step 2: Role Specific -->
            <div class="onboarding-step hidden" data-step="2">
                @if(auth()->user()->role === 'joueur')
                    <div class="w-24 h-24 bg-benin-yellowLight rounded-[2rem] flex items-center justify-center text-benin-yellow text-4xl mx-auto mb-8">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h2 class="text-3xl font-black text-benin-dark mb-4">Boostez votre visibilité</h2>
                    <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                        Complétez votre profil, ajoutez vos meilleures vidéos et gardez un œil sur votre compteur de vues. Plus votre profil est riche, plus vous attirez les recruteurs !
                    </p>
                @elseif(auth()->user()->role === 'coach')
                    <div class="w-24 h-24 bg-benin-greenLight rounded-[2rem] flex items-center justify-center text-benin-green text-4xl mx-auto mb-8">
                        <i class="fas fa-whistle"></i>
                    </div>
                    <h2 class="text-3xl font-black text-benin-dark mb-4">Gérez votre effectif</h2>
                    <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                        Inscrivez vos joueurs, évaluez leurs performances techniques et validez leurs profils pour les rendre publics sur le réseau SmartPlayer.
                    </p>
                @elseif(auth()->user()->role === 'recruteur')
                    <div class="w-24 h-24 bg-red-100 rounded-[2rem] flex items-center justify-center text-red-500 text-4xl mx-auto mb-8">
                        <i class="fas fa-search-dollar"></i>
                    </div>
                    <h2 class="text-3xl font-black text-benin-dark mb-4">Dénichez des pépites</h2>
                    <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                        Utilisez nos filtres multicritères, sauvegardez vos talents favoris et contactez directement les académies pour des prises de contact.
                    </p>
                @else
                    <div class="w-24 h-24 bg-slate-100 rounded-[2rem] flex items-center justify-center text-slate-800 text-4xl mx-auto mb-8">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <h2 class="text-3xl font-black text-benin-dark mb-4">Pilotez votre Académie</h2>
                    <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                        Supervisez vos coachs et accédez aux statistiques globales de vos joueurs pour un suivi optimal de votre centre de formation.
                    </p>
                @endif
                <button onclick="nextStep()" class="bg-benin-dark text-white px-10 py-4 rounded-2xl font-black hover:bg-black transition-all shadow-xl">
                    Suivant <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>

            <!-- Step 3: Final -->
            <div class="onboarding-step hidden" data-step="3">
                <div class="w-24 h-24 bg-green-100 rounded-[2rem] flex items-center justify-center text-green-600 text-4xl mx-auto mb-8">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="text-3xl font-black text-benin-dark mb-4">Vous êtes prêt !</h2>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed">
                    Explorez votre tableau de bord dès maintenant. Nous restons à votre disposition via la messagerie pour toute assistance.
                </p>
                <button onclick="finishOnboarding()" class="bg-benin-green text-white px-10 py-4 rounded-2xl font-black hover:bg-green-700 transition-all shadow-xl shadow-green-500/20">
                    Découvrir mon espace <i class="fas fa-check ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    function nextStep() {
        document.querySelector(`.onboarding-step[data-step="${currentStep}"]`).classList.add('hidden');
        currentStep++;
        document.querySelector(`.onboarding-step[data-step="${currentStep}"]`).classList.remove('hidden');
        document.getElementById('onboarding-progress').style.width = (currentStep * 33) + '%';
    }

    function dismissOnboarding() {
        document.getElementById('onboarding-overlay').classList.add('animate-out', 'fade-out', 'zoom-out', 'duration-300');
        setTimeout(() => {
            document.getElementById('onboarding-overlay').remove();
        }, 300);
    }

    function finishOnboarding() {
        fetch('{{ route("onboarding.complete") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => dismissOnboarding());
    }
</script>
@endif
