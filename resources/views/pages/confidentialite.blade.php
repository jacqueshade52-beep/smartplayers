@extends('pages.base')

@section('title', 'Politique de Confidentialité')
@section('icon', '🛡️')

@section('page_content')
<div class="space-y-8">
    <section>
        <h2 class="text-2xl font-bold text-benin-dark mb-4">1. Données collectées</h2>
        <p class="text-slate-600 leading-relaxed mb-4">
            Nous collectons des données personnelles essentielles à votre expérience sur la plateforme <strong>SmartPlayer</strong> :
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Identité :</strong> Nom, Prénom, Date de Naissance.</li>
            <li><strong>Profil Sportif :</strong> Taille, Poids, Vidéos Highlights, Statistiques de matchs.</li>
            <li><strong>Contact :</strong> Email, Numéro de Téléphone (Facultatif).</li>
        </ul>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-benin-dark mb-4">2. Utilisation des données</h2>
        <p class="text-slate-600 leading-relaxed">
            Vos données sont utilisées pour permettre aux recruteurs de découvrir vos talents, de vous proposer des opportunités et de faciliter la mise en relation avec votre académie actuelle. Vos statistiques et vidéos sont affichées publiquement après validation par votre coach.
        </p>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-benin-dark mb-4">3. Vos Droits</h2>
        <p class="text-slate-600 leading-relaxed">
            Conformément à la protection des données personnelles, vous disposez d'un droit d'accès, de rectification et d'opposition pour vos données personnelles directement depuis votre tableau de bord utilisateur.
        </p>
    </section>

    <div class="bg-blue-50 p-6 rounded-2xl border-l-4 border-blue-500">
        <p class="text-blue-700 font-medium italic">Vos données de paiement ne sont jamais stockées sur nos serveurs. Nous utilisons des services de paiement sécurisés tiers.</p>
    </div>
</div>
@endsection
