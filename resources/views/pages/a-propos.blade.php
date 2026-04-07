@extends('pages.base')

@section('title', 'À propos de SmartPlayer')
@section('icon', '💡')

@section('page_content')
<div class="space-y-8">
    <section>
        <h3 class="text-3xl font-black text-benin-green mb-6 leading-tight">La vision : Unir les Talents du football Africain.</h3>
        <p class="text-slate-600 text-lg leading-relaxed">
            <strong>SmartPlayer</strong> est née d'un constat simple : l'Afrique regorge de talents footballistiques exceptionnels, mais beaucoup d'entre eux manquent de visibilité auprès des recruteurs internationaux et nationaux.
        </p>
    </section>

    <div class="grid md:grid-cols-2 gap-8 my-12">
        <div class="bg-benin-greenLight p-8 rounded-[2rem] border border-benin-green/10">
            <h4 class="font-bold text-benin-green text-xl mb-4">Notre mission</h4>
            <p class="text-benin-green font-medium text-sm leading-relaxed">Offrir une plateforme technologique robuste pour digitaliser les performances des joueurs et faciliter les transferts éthiques.</p>
        </div>
        <div class="bg-benin-yellowLight p-8 rounded-[2rem] border border-benin-yellow/10">
            <h4 class="font-bold text-benin-dark text-xl mb-4">Notre impact</h4>
            <p class="text-benin-dark font-medium text-sm leading-relaxed">Plus de visibilité, plus d'opportunités, et une transparence totale entre les académies et les clubs professionnels.</p>
        </div>
    </div>

    <section>
        <p class="text-slate-600 leading-relaxed italic border-l-4 border-slate-200 pl-6">
            "Le futur du football se joue ici. SmartPlayer est l'outil qui manquait au continent."
        </p>
    </section>
</div>
@endsection
