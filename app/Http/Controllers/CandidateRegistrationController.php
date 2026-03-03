<?php

namespace App\Http\Controllers;

use App\Models\CandidateIntern;
use Illuminate\Http\Request;

use App\Models\Lowongan;

class CandidateRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $lowonganId = $request->query('lowongan_id');
        $lowongans = Lowongan::where('status', 'open')->get();
        return view('candidate-registration', compact('lowongans', 'lowonganId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:candidate_interns,nik',
            'transcript' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'photo' => 'required|image|max:2048',
            'description' => 'nullable|string',
            'lowongan_id' => 'nullable|exists:lowongans,id',
        ]);

        $transcriptPath = $request->file('transcript')->store('candidate-interns/transcripts', 'public');
        $cvPath = $request->file('cv')->store('candidate-interns/cvs', 'public');
        $photoPath = $request->file('photo')->store('candidate-interns/photos', 'local');

        CandidateIntern::create([
            'name' => $validated['name'],
            'nik' => $validated['nik'],
            'description' => $validated['description'] ?? null,
            'lowongan_id' => $validated['lowongan_id'] ?? null,
            'transcript_path' => $transcriptPath,
            'cv_path' => $cvPath,
            'photo_path' => $photoPath,
             // user_id is nullable, so we don't need to set it for guest registration
        ]);

        return redirect()->route('candidate.register')->with('success', 'Pendaftaran berhasil! Data Anda telah tersimpan.');
    }
}
