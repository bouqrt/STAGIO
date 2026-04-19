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
    $request->validate([
        'cv' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $offre = Offre::findOrFail($id);

    $cvPath = $request->file('cv')->store('cvs', 'public');

    Candidature::create([
        'user_id' => auth()->id(),
        'offre_id' => $offre->id,
        'cv' => $cvPath,
    ]);

    return back()->with('success', 'Candidature envoyée avec CV');
    }

    public function index(){
        $candidatures = Candidature::with('user', 'offre')->get();
         
        return view('entreprise.candidatures.index', compact('candidatures'));
    }

    public function accept($id)
    {
    $candidature = Candidature::findOrFail($id);
    $candidature->update([
        'status' => 'accepted'
    ]);

    return back();
    }

    public function refuse($id)
    {
    $candidature = Candidature::findOrFail($id);
    $candidature->update([
        'status' => 'refused'
    ]);

    return back();
    }
}
