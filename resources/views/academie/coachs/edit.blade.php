@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-3xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200 text-center">
            <a href="{{ route('academie.coachs') }}" class="text-sm text-slate-400 hover:text-benin-green mb-4 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour à la liste</a>
            <h1 class="text-3xl font-extrabold text-benin-dark mb-2">Modifier le profil Coach</h1>
            <p class="text-slate-500">Mettez à jour les informations de <strong>{{ $coach->prenom }} {{ $coach->nom }}</strong>.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('academie.coachs.update', $coach->id) }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom <span class="text-benin-red">*</span></label>
                        <input type="text" name="prenom" value="{{ $coach->prenom }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-benin-red">*</span></label>
                        <input type="text" name="nom" value="{{ $coach->nom }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email de contact (Non modifiable)</label>
                        <input type="email" value="{{ $coach->user->email }}" class="w-full px-5 py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-400 cursor-not-allowed" readonly>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie assignée <span class="text-benin-red">*</span></label>
                        <select name="categorie" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-slate-600">
                            <option value="U15" {{ $coach->categorie == 'U15' ? 'selected' : '' }}>Formation U15</option>
                            <option value="U17" {{ $coach->categorie == 'U17' ? 'selected' : '' }}>Formation U17</option>
                            <option value="U19" {{ $coach->categorie == 'U19' ? 'selected' : '' }}>Formation U19</option>
                            <option value="Réserves" {{ $coach->categorie == 'Réserves' ? 'selected' : '' }}>Réserves (Seniors)</option>
                            <option value="Pro" {{ $coach->categorie == 'Pro' ? 'selected' : '' }}>Professionnel</option>
                        </select>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex justify-end gap-4 mt-8">
                    <a href="{{ route('academie.coachs') }}" class="px-8 py-4 rounded-xl font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-all">Annuler</a>
                    <button type="submit" class="px-8 py-4 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 shadow-xl shadow-green-500/20 transition-all hover:-translate-y-0.5">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
