@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 bg-slate-50 relative overflow-hidden flex items-center justify-center">
    <div class="max-w-xl w-full px-6 relative z-10">
        <div class="bg-white rounded-[2rem] p-10 shadow-2xl border border-slate-100 reveal">
            <h2 class="text-3xl font-extrabold text-center text-benin-dark mb-2">Inscription Joueur</h2>
            <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="role" value="joueur">
                <p>Contactez le coach de votre académie pour qu'il vous crée un compte, ou inscrivez-vous en libre accès.</p>
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-2xl text-xs text-blue-800">
                    <strong>Note:</strong> Valider vous connectera avec le rôle <em>Joueur</em>.
                </div>
                <button type="submit" class="w-full bg-benin-yellow hover:bg-yellow-400 text-benin-dark px-8 py-4 rounded-2xl font-bold shadow-xl transition-all hover:-translate-y-1">Valider l'inscription <i class="fas fa-running ml-2"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
