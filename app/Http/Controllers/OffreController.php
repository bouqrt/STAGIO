<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    // Show the form used to create an offer.
    public function create()
    {
        return view('offres.create');
    }

    // Store a new offer for the connected entreprise.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:stage,alternance',
        ]);

        $entreprise = auth()->user()->entreprise;

        if (! $entreprise) {
            return redirect()->route('entreprise.create')->with('error', 'Create your entreprise profile first.');
        }

        Offre::create([
            'entreprise_id' => $entreprise->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'is_published' => true,
        ]);

        return redirect()->route('offres.index')->with('success', 'Offer created successfully.');
    }

    // Get all offers.
    public function index()
    {
        $query = Offre::with('entreprise')->latest();

        if (auth()->user()->role === 'entreprise') {
            $entrepriseId = optional(auth()->user()->entreprise)->id;
            $query->where('entreprise_id', $entrepriseId);
        }

        $offres = $query->get();

        return view('offres.index', compact('offres'));
    }
}
