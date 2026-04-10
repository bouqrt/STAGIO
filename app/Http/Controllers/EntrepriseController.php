<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function create ()
    {
        return view('entreprise.create');
    }

    public function store(request $request)
    {
        Entreprise::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
    ]);

    return redirect('/entreprise/dashboard');
    
    }
}
