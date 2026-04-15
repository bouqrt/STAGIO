<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offre;


class OffreController extends Controller
{
    public function create()
{
    return view('offres.create');
}

public function store(Request $request)
{
    $entreprise = auth()->user()->entreprise;

    Offre::create([
        'entreprise_id' => $entreprise->id,
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'type' => $request->type,
    ]);

    return redirect('/entreprise/dashboard');
}
}
