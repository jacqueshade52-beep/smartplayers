@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-[3rem] p-12 shadow-xl border border-slate-100 reveal">
            <div class="mb-10 text-center">
                <div class="w-16 h-16 bg-benin-greenLight text-benin-green rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4">
                    @yield('icon')
                </div>
                <h1 class="text-4xl font-extrabold text-benin-dark tracking-tight">@yield('title')</h1>
                <div class="w-20 h-1.5 bg-benin-yellow mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="prose prose-slate max-w-none">
                @yield('page_content')
            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-400">Dernière mise à jour : {{ date('d/m/Y') }}</p>
                <div class="mt-6">
                    <a href="{{ route('accueil') }}" class="text-benin-green font-bold hover:underline">
                        <i class="fas fa-arrow-left mr-2"></i> Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
