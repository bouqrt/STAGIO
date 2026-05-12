<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CandidatureController extends Controller
{
    // Store a new student application.
    public function store(Request $request, $id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $offre = Offre::findOrFail($id);

        $alreadyApplied = Candidature::where('user_id', auth()->id())
            ->where('offre_id', $offre->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You already applied to this offer.');
        }

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Candidature::create([
            'user_id' => auth()->id(),
            'offre_id' => $offre->id,
            'cv' => $cvPath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application sent successfully.');
    }

    // Show applications received by the connected entreprise.
    public function index()
    {
        $entrepriseId = optional(auth()->user()->entreprise)->id;

        $candidatures = Candidature::with('user', 'offre')
            ->whereHas('offre', function ($query) use ($entrepriseId) {
                $query->where('entreprise_id', $entrepriseId);
            })
            ->latest()
            ->get();

        return view('entreprise.candidatures.index', compact('candidatures'));
    }

    // Show applications sent by the current student.
    public function studentIndex()
    {
        $candidatures = Candidature::with('offre')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('student.applications', compact('candidatures'));
    }

    // Stream a candidate CV only to the entreprise that owns the offer.
    public function showCv($id)
    {
        $entrepriseId = optional(auth()->user()->entreprise)->id;

        $candidature = Candidature::whereHas('offre', function ($query) use ($entrepriseId) {
            $query->where('entreprise_id', $entrepriseId);
        })->findOrFail($id);

        if (! $candidature->cv || ! Storage::disk('public')->exists($candidature->cv)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($candidature->cv);
        $mimeType = Storage::disk('public')->mimeType($candidature->cv) ?? 'application/octet-stream';

        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => (new ResponseHeaderBag())->makeDisposition(
                ResponseHeaderBag::DISPOSITION_INLINE,
                basename($candidature->cv)
            ),
        ]);
    }

    // Mark an application as accepted.
    public function accept($id)
    {
        $entrepriseId = optional(auth()->user()->entreprise)->id;

        $candidature = Candidature::whereHas('offre', function ($query) use ($entrepriseId) {
            $query->where('entreprise_id', $entrepriseId);
        })->findOrFail($id);

        $candidature->update([
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Application accepted successfully.');
    }

    // Mark an application as refused.
    public function refuse($id)
    {
        $entrepriseId = optional(auth()->user()->entreprise)->id;

        $candidature = Candidature::whereHas('offre', function ($query) use ($entrepriseId) {
            $query->where('entreprise_id', $entrepriseId);
        })->findOrFail($id);

        $candidature->update([
            'status' => 'refused',
        ]);

        return back()->with('success', 'Application refused successfully.');
    }
}
