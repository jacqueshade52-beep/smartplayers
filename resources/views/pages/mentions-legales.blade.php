@extends('pages.base')

@section('title', 'Mentions Légales')
@section('icon', '📜')

@section('page_content')
<div class="space-y-8">
    <section>
        <h2 class="text-2xl font-bold text-benin-dark mb-4">1. Éditeur de la plateforme</h2>
        <p class="text-slate-600 leading-relaxed">
            <strong>SmartPlayer</strong>, une initiative de <strong>FootTalents Africa</strong>, à Cotonou, Bénin.
        </p>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-benin-dark mb-4">2. Hébergement</h2>
        <p class="text-slate-600 leading-relaxed">
            L'hébergement de la plateforme est assuré par <strong>CloudFormation</strong> (serveurs situés en Europe).
        </p>
    </section>

    <div class="bg-gray-50 border-2 border-dashed border-gray-200 p-8 rounded-[2rem] text-center">
        <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-sm">Contenu en attente de validation légale par le département juridique.</p>
    </div>
</div>
@endsection
