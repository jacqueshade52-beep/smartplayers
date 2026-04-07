<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            session(['role' => $user->role]);

            if ($user->role === 'academie')  return redirect()->route('academie.dashboard');
            if ($user->role === 'coach')     return redirect()->route('coach.dashboard');
            if ($user->role === 'joueur')    return redirect()->route('joueur.dashboard');
            if ($user->role === 'recruteur') return redirect()->route('recruteur.dashboard');

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas avec nos enregistrements.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('accueil');
    }

    // ── Pages des formulaires ─────────────────────────────────────────────

    public function registerAcademie()
    {
        return view('auth.register-academie');
    }

    public function registerRecruteur()
    {
        return view('auth.register-recruteur');
    }

    public function registerJoueur()
    {
        return view('auth.register-joueur');
    }

    // ── Traitement des inscriptions ───────────────────────────────────────

    /**
     * Inscription d'une Académie (centre de formation)
     */
    public function storeAcademie(Request $request)
    {
        $request->validate([
            'nom_academie'       => 'required|string|max:255',
            'ville'              => 'required|string|max:100',
            'pays'               => 'required|string|max:100',
            'email'              => 'required|email|unique:users,email',
            'password'           => 'required|string|min:8|confirmed',
        ], [
            'email.unique'          => 'Un compte existe déjà avec cet email.',
            'password.min'          => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'    => 'Les deux mots de passe ne correspondent pas.',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->nom_academie,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'     => 'academie',
        ]);

        $user->academie()->create([
            'nom'  => $request->nom_academie,
            'ville' => $request->ville,
            'pays'  => $request->pays,
        ]);

        auth()->login($user);
        $request->session()->regenerate();
        session(['role' => 'academie']);

        return redirect()->route('academie.dashboard')
            ->with('success', "Bienvenue ! Votre espace académie a été créé avec succès.");
    }

    /**
     * Inscription d'un Recruteur / Agent
     */
    public function storeRecruteur(Request $request)
    {
        $request->validate([
            'prenom'       => 'required|string|max:100',
            'nom'          => 'required|string|max:100',
            'organisation' => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:8|confirmed',
        ], [
            'email.unique'          => 'Un compte existe déjà avec cet email.',
            'password.min'          => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'    => 'Les deux mots de passe ne correspondent pas.',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->prenom . ' ' . $request->nom,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'     => 'recruteur',
        ]);

        $user->recruteur()->create([
            'prenom'       => $request->prenom,
            'nom'          => $request->nom,
            'organisation' => $request->organisation,
            'fonction'     => $request->fonction ?? 'Recruteur',
        ]);

        auth()->login($user);
        $request->session()->regenerate();
        session(['role' => 'recruteur']);

        return redirect()->route('recruteur.dashboard')
            ->with('success', "Bienvenue ! Votre compte recruteur a été créé avec succès.");
    }

    /**
     * Inscription d'un Joueur (Autonome)
     */
    public function storeJoueur(Request $request)
    {
        $request->validate([
            'prenom'   => 'required|string|max:100',
            'nom'      => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique'       => 'Un compte existe déjà avec cet email.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les deux mots de passe ne correspondent pas.',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->prenom . ' ' . $request->nom,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'     => 'joueur',
        ]);

        $user->joueur()->create([
            'prenom' => $request->prenom,
            'nom'    => $request->nom,
            'statut' => 'brouillon' // Profil incomplet au départ
        ]);

        auth()->login($user);
        $request->session()->regenerate();
        session(['role' => 'joueur']);

        return redirect()->route('joueur.dashboard')
            ->with('success', "Bienvenue sur SmartPlayer ! Complétez maintenant votre profil pour être visible.");
    }
}
