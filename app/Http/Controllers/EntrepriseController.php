<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    // Show the entreprise profile form.
    public function create()
    {
        return view('entreprise.create', [
            'entreprise' => auth()->user()->entreprise,
        ]);
    }

    // Create or update the entreprise profile for the current user.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Entreprise::updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Entreprise profile saved successfully.');
    }
}
