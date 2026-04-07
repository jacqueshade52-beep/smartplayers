@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-10 pb-6 border-b border-slate-200">
            <a href="{{ route('academie.dashboard') }}" class="text-sm text-slate-400 hover:text-benin-green mb-2 inline-block"><i class="fas fa-arrow-left mr-1"></i> Retour au tableau de bord</a>
            <h1 class="text-3xl font-extrabold text-benin-dark flex items-center gap-3 mt-2">
                <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-lg"><i class="fas fa-building"></i></div>
                Vitrine de l'Académie
            </h1>
            <p class="text-slate-500 mt-1">Gérez les informations publiques de <strong>{{ $academie->nom ?? 'votre structure' }}</strong>.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-12 reveal">
            <form action="{{ route('academie.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- En-tête / Logo -->
                <div class="flex flex-col md:flex-row items-center gap-8 mb-8 pb-8 border-b border-slate-100">
                    <div class="relative group" onclick="document.getElementById('logo-input').click()">
                        <div class="w-32 h-32 rounded-[2rem] shadow-md border-4 border-white bg-slate-100 flex items-center justify-center font-bold text-3xl text-slate-300 overflow-hidden group-hover:bg-slate-200 transition-colors cursor-pointer">
                            @if($academie->logo)
                                <img id="logo-preview" src="{{ asset('storage/' . $academie->logo) }}" class="w-full h-full object-cover">
                            @else
                                <div id="logo-placeholder" class="text-slate-300"><i class="fas fa-camera"></i></div>
                                <img id="logo-preview" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <div class="absolute -bottom-3 -right-3 w-10 h-10 bg-benin-green text-white rounded-full flex items-center justify-center border-4 border-white shadow-sm cursor-pointer hover:scale-110 transition-transform">
                            <i class="fas fa-pencil-alt text-sm"></i>
                        </div>
                        <input type="file" name="logo" id="logo-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div>
                        <h3 class="font-bold text-xl text-slate-800 mb-2">Logo de l'institution</h3>
                        <p class="text-sm text-slate-500 mb-4 max-w-sm">Recommandé : <br>Image carrée PNG ou JPG, taille minimale 400x400px, poids max 2Mo.</p>
                        <button type="button" onclick="document.getElementById('logo-input').click()" class="text-sm font-bold text-benin-green border-2 border-green-100 bg-green-50 px-4 py-2 rounded-xl hover:bg-green-100 transition-colors">Changer le logo</button>
                    </div>
                </div>

                <script>
                    function previewImage(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('logo-preview').src = e.target.result;
                                document.getElementById('logo-preview').classList.remove('hidden');
                                if (document.getElementById('logo-placeholder')) {
                                    document.getElementById('logo-placeholder').classList.add('hidden');
                                }
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <!-- Informations générales -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-info-circle text-slate-400"></i> Informations générales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom de l'académie <span class="text-benin-red">*</span></label>
                            <input type="text" name="nom" value="{{ $academie->nom ?? '' }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all font-bold text-slate-800">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Ville d'implantation <span class="text-benin-red">*</span></label>
                            <input type="text" name="ville" value="{{ $academie->ville ?? '' }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pays <span class="text-benin-red">*</span></label>
                            <input type="text" name="pays" value="{{ $academie->pays ?? '' }}" required class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Présentation -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-bullhorn text-slate-400"></i> Présentation & Philosophie</h3>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Description complète (Histoire, vision, etc.)</label>
                        <textarea name="description" rows="6" class="w-full px-5 py-4 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">{{ $academie->description ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Contact public -->
                <div>
                    <h3 class="text-xl font-bold flex items-center gap-2 mb-6 text-benin-dark border-b border-slate-100 pb-2"><i class="fas fa-address-book text-slate-400"></i> Contact Public</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Site web ou réseau social principal</label>
                            <input type="url" name="site_web" placeholder="https://" value="{{ $academie->site_web ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all text-blue-600">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email public de contact</label>
                            <input type="email" name="email_contact" placeholder="contact@..." value="{{ $academie->email_contact ?? '' }}" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-benin-green focus:bg-white focus:ring-4 focus:ring-green-500/10 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-8 flex flex-col-reverse md:flex-row justify-end gap-4 mt-8">
                    <a href="{{ route('academie.public', isset($academie->id) ? $academie->id : 1) }}" target="_blank" class="w-full md:w-auto text-center px-8 py-4 rounded-xl font-bold text-benin-dark border-2 border-slate-200 hover:border-benin-dark bg-white transition-all"><i class="fas fa-eye mr-2"></i> Voir le rendu public</a>
                    <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-xl font-bold text-white bg-benin-green hover:bg-green-700 shadow-xl shadow-green-500/20 transition-all hover:-translate-y-0.5"><i class="fas fa-save mr-2"></i> Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
