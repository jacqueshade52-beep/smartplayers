@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 flex items-center justify-between">
            <div>
                <a href="{{ route('coach.joueurs') }}" class="text-benin-green font-bold flex items-center gap-2 mb-4 hover:underline">
                    <i class="fas fa-arrow-left"></i> Retour à mes joueurs
                </a>
                <h1 class="text-4xl font-extrabold text-benin-dark tracking-tight">Nouvelle Évaluation</h1>
                <p class="text-slate-500 mt-2">Évaluation technique pour <span class="font-bold text-benin-green">{{ $joueur->prenom }} {{ $joueur->nom }}</span></p>
            </div>
            <div class="w-20 h-20 rounded-2xl overflow-hidden border-4 border-white shadow-lg">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($joueur->prenom . ' ' . $joueur->nom) }}&background=e6f3ed&color=008751&size=512" alt="">
            </div>
        </div>

        <form action="{{ route('coach.evaluations.store', $joueur->id) }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Compétences Techniques -->
                    <div class="space-y-8">
                        <h3 class="text-xl font-black text-benin-dark flex items-center gap-3 border-b border-slate-100 pb-4">
                            <i class="fas fa-football-ball text-benin-green"></i> Aptitudes Techniques
                        </h3>
                        
                        <div class="space-y-6">
                            @foreach([
                                'vitesse' => ['label' => 'Vitesse & Explosivité', 'icon' => 'bolt', 'color' => 'yellow'],
                                'frappe' => ['label' => 'Précision de Frappe', 'icon' => 'bullseye', 'color' => 'red'],
                                'dribble' => ['label' => 'Maîtrise du Dribble', 'icon' => 'sync', 'color' => 'blue']
                            ] as $name => $info)
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <label class="font-bold text-slate-700 flex items-center gap-2">
                                        <i class="fas fa-{{ $info['icon'] }} text-benin-{{ $info['color'] }}"></i> {{ $info['label'] }}
                                    </label>
                                    <span id="val-{{ $name }}" class="bg-slate-100 px-3 py-1 rounded-lg text-sm font-black text-benin-dark">50</span>
                                </div>
                                <input type="range" name="{{ $name }}" value="50" min="0" max="100" 
                                    class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-benin-green range-input"
                                    oninput="document.getElementById('val-{{ $name }}').innerText = this.value">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Compétences Tactiques/Physiques -->
                    <div class="space-y-8">
                        <h3 class="text-xl font-black text-benin-dark flex items-center gap-3 border-b border-slate-100 pb-4">
                            <i class="fas fa-brain text-benin-yellow"></i> Mental & Physique
                        </h3>
                        
                        <div class="space-y-6">
                            @foreach([
                                'vision_jeu' => ['label' => 'Vision de Jeu', 'icon' => 'eye', 'color' => 'green'],
                                'physique' => ['label' => 'Impact Physique', 'icon' => 'dumbbell', 'color' => 'dark'],
                                'passe' => ['label' => 'Qualité de Passe', 'icon' => 'share', 'color' => 'yellow']
                            ] as $name => $info)
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <label class="font-bold text-slate-700 flex items-center gap-2">
                                        <i class="fas fa-{{ $info['icon'] }} text-benin-{{ $info['color'] }}"></i> {{ $info['label'] }}
                                    </label>
                                    <span id="val-{{ $name }}" class="bg-slate-100 px-3 py-1 rounded-lg text-sm font-black text-benin-dark">50</span>
                                </div>
                                <input type="range" name="{{ $name }}" value="50" min="0" max="100" 
                                    class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-benin-green range-input"
                                    oninput="document.getElementById('val-{{ $name }}').innerText = this.value">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commentaire & Date -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-slate-100">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-bold text-slate-700">Date de l'évaluation</label>
                            <input type="date" name="date_evaluation" value="{{ date('Y-m-d') }}" 
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-benin-green font-medium">
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="font-bold text-slate-700">Commentaire Global & Avis du Coach</label>
                        <textarea name="commentaire_coach" rows="4" placeholder="Points forts, axes d'amélioration..."
                            class="w-full bg-slate-50 border-none rounded-3xl p-6 focus:ring-2 focus:ring-benin-green font-medium"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <button type="submit" class="bg-benin-green text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-green-500/20 hover:bg-green-700 transition-all hover:-translate-y-1">
                    ENREGISTRER L'ÉVALUATION
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Style personnalisé pour les inputs range */
.range-input::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 24px;
    height: 24px;
    background: white;
    border: 4px solid #008751;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>
@endsection
