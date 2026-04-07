<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Joueur - {{ $joueur->prenom }} {{ $joueur->nom }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; padding: 0; }
            .print-shadow { box-shadow: none !important; border: 1px solid #eee; }
        }
        .benin-green { color: #008751; }
        .bg-benin-green { background-color: #008751; }
        .benin-yellow { color: #FCD116; }
    </style>
</head>
<body class="bg-slate-50 font-sans p-8">

    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-[2rem] overflow-hidden print-shadow">
        <!-- Barre de commande No-Print -->
        <div class="no-print bg-slate-800 p-4 flex justify-between items-center text-white">
            <span class="text-sm font-medium"><i class="fas fa-file-pdf mr-2 text-benin-yellow"></i> Rapport Généré par SmartPlayer</span>
            <button onclick="window.print()" class="bg-benin-green hover:bg-green-700 text-white px-6 py-2 rounded-full font-bold transition-all text-sm">
                <i class="fas fa-print mr-2"></i> Imprimer le rapport
            </button>
        </div>

        <!-- Header -->
        <div class="bg-benin-green p-10 text-white flex flex-col md:flex-row gap-8 items-center">
            <div class="w-32 h-32 rounded-2xl border-4 border-white/20 overflow-hidden shrink-0 bg-white">
                <img src="{{ $joueur->user && $joueur->user->photo_profil ? asset('storage/' . $joueur->user->photo_profil) : 'https://ui-avatars.com/api/?name='.urlencode($joueur->prenom.' '.$joueur->nom).'&background=ffffff&color=008751&size=200' }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-4xl font-black mb-2">{{ $joueur->prenom }} {{ $joueur->nom }}</h1>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start items-center">
                    <span class="bg-white/20 px-4 py-1 rounded-full text-sm font-bold uppercase tracking-widest">{{ $joueur->poste }}</span>
                    <span class="text-white/80"><i class="fas fa-calendar mr-2"></i>{{ $joueur->age }} ans ({{ \Carbon\Carbon::parse($joueur->date_naissance)->format('d/m/Y') }})</span>
                    <span class="text-white/80"><i class="fas fa-map-marker-alt mr-2"></i>{{ $joueur->nationalite ?? 'Béninois' }}</span>
                </div>
            </div>
            <div class="text-right hidden md:block">
                <div class="text-2xl font-black text-benin-yellow">SmartPlayer</div>
                <div class="text-xs opacity-60 uppercase tracking-tighter">Profil Certifié</div>
            </div>
        </div>

        <!-- Stats Grille -->
        <div class="grid grid-cols-2 md:grid-cols-4 border-b border-slate-100 divide-x divide-slate-100">
            <div class="p-6 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Pied Fort</p>
                <p class="text-lg font-black text-slate-700">{{ $joueur->pied_fort }}</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Taille</p>
                <p class="text-lg font-black text-slate-700">{{ $joueur->taille ?? '-' }} cm</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Poids</p>
                <p class="text-lg font-black text-slate-700">{{ $joueur->poids ?? '-' }} kg</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Catégorie</p>
                <p class="text-lg font-black text-slate-700">{{ $joueur->categorie ?? 'U19' }}</p>
            </div>
        </div>

        <div class="p-10 grid lg:grid-cols-3 gap-12">
            <!-- Colonne Gauche -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Biographie -->
                <section>
                    <h3 class="text-xl font-bold text-slate-800 mb-4 flex items-center gap-3">
                        <div class="w-1 h-6 bg-benin-green rounded-full"></div> Biographie Professionnelle
                    </h3>
                    <p class="text-slate-600 leading-relaxed italic">
                        {{ $joueur->description ?? "Aucune description biographique n'a été fournie pour ce profil." }}
                    </p>
                </section>

                <!-- Dernières Evaluations -->
                <section>
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <div class="w-1 h-6 bg-benin-green rounded-full"></div> Analyse Technique & Tactique
                    </h3>
                    
                    @if($joueur->evaluations->count() > 0)
                        @php $lastEval = $joueur->evaluations->first(); @endphp
                        <div class="grid grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl border border-slate-100">
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Vitesse</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->vitesse }}%"></div></div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Physique</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->physique }}%"></div></div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Frappe</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->frappe }}%"></div></div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Passe</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->passe }}%"></div></div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Dribble</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->dribble }}%"></div></div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase">Vision</label>
                                <div class="w-full bg-slate-200 h-2 rounded-full mt-1"><div class="bg-benin-green h-2 rounded-full" style="width: {{ $lastEval->vision_jeu }}%"></div></div>
                            </div>
                        </div>
                        <div class="mt-4 p-4 bg-white border border-slate-100 rounded-2xl">
                            <h4 class="text-xs font-bold text-benin-green uppercase mb-2">Avis du Coach</h4>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $lastEval->commentaire_coach ?? 'Analyse positive du talent par le staff technique.' }}</p>
                        </div>
                    @else
                        <div class="p-8 text-center bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 text-slate-400 italic">
                            Évaluations techniques en cours de traitement...
                        </div>
                    @endif
                </section>
            </div>

            <!-- Colonne Droite (Club & Contact) -->
            <div class="space-y-8">
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100">
                    <h4 class="text-xs font-bold text-slate-400 uppercase mb-4">Formation Actuelle</h4>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center font-bold text-benin-green border border-slate-100">
                            @if($joueur->academie->logo)
                                <img src="{{ asset('storage/' . $joueur->academie->logo) }}" class="w-full h-full object-contain p-1">
                            @else
                                {{ substr($joueur->academie->nom, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">{{ $joueur->academie->nom }}</p>
                            <p class="text-xs text-slate-500">{{ $joueur->academie->ville }}, {{ $joueur->academie->pays }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-benin-dark rounded-3xl p-6 text-white text-center">
                    <p class="text-xs font-bold uppercase opacity-50 mb-2">Contact Academy</p>
                    <p class="font-bold mb-1">{{ $joueur->academie->email_contact ?? $joueur->academie->user->email ?? 'contact@smartplayer.africa' }}</p>
                    <p class="text-xs opacity-70">Référence J#{{ str_pad($joueur->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="pt-6 text-center">
                    <div class="inline-block p-4 border-2 border-slate-100 rounded-2xl">
                         <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode(route('joueur.public', $joueur->id)) }}" alt="QR Code" class="w-20 h-20 mx-auto">
                         <p class="text-[10px] text-slate-400 mt-2 uppercase font-bold">Scanner pour le profil digital</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Rapport -->
        <div class="bg-slate-50 p-8 text-center border-t border-slate-100">
            <p class="text-xs text-slate-400 leading-relaxed max-w-lg mx-auto">
                Ce document a été généré via la plateforme SmartPlayer. Les données sont certifiées par l'académie de formation {{ $joueur->academie->nom }} au {{ date('d/m/Y') }}. Toute reproduction sans autorisation est interdite.
            </p>
        </div>
    </div>

</body>
</html>
