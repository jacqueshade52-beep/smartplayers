<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aPropos() { return view('pages.a-propos'); }
    public function cgu() { return view('pages.cgu'); }
    public function mentionsLegales() { return view('pages.mentions-legales'); }
    public function confidentialite() { return view('pages.confidentialite'); }
    public function carrieres() { return view('pages.placeholder'); }
    public function blog() { return view('pages.placeholder'); }
    public function partenaires() { return view('pages.placeholder'); }
    public function annuaire() { return view('pages.placeholder'); }
    public function methodologie() { return view('pages.placeholder'); }
    public function tarifs() { return view('pages.placeholder'); }
}
