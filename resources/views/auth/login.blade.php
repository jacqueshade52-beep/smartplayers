@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 bg-slate-50 relative overflow-hidden flex items-center justify-center">
    <div class="absolute top-0 right-0 w-96 h-96 bg-benin-green/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-benin-yellow/10 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full px-6 relative z-10">
        <div class="bg-white rounded-[2rem] p-10 shadow-2xl border border-slate-100 reveal">
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-benin-green to-benin-yellow flex items-center justify-center text-white text-lg">
                    <i class="fas fa-futbol"></i>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-center text-benin-dark mb-2">Bienvenue</h2>
            <p class="text-slate-500 text-center mb-10 text-sm">Connectez-vous à votre espace personnel</p>

            <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@SmartPlayer" required
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-200' }} focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700">Mot de passe</label>
                        <a href="#" class="text-xs font-semibold text-benin-green hover:underline">Oublié ?</a>
                    </div>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full px-6 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                </div>

                <button type="submit"
                    class="w-full bg-benin-green hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-green-500/30 transition-all hover:-translate-y-1">
                    Se connecter <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <p class="text-sm text-slate-500">Pas encore de compte ?</p>
                <div class="flex justify-center flex-wrap gap-2 mt-2">
                    <a href="{{ route('register.academie') }}" class="text-sm font-semibold text-benin-dark hover:text-benin-green">Académie</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('register.recruteur') }}" class="text-sm font-semibold text-benin-dark hover:text-benin-red">Recruteur</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
