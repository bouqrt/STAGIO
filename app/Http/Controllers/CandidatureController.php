<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function store(Request $request, $id)
    {
    $offre = Offre::findOrFail($id);

    Candidature::create([
        'user_id' => auth()->id(),
        'offre_id' => $offre->id,
    ]);

        return back()->with('success', 'Candidature envoyée');
    }

    public function index(){
        $candidatures = Candidature::with('user', 'offre')->get();
         
        return view('entreprise.candidatures.index', compact('candidatures'));
    }
}
