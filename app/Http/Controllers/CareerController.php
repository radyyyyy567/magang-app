<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of available internship positions
     */
    public function index()
    {
        $activities = Activity::with(['division', 'mentor'])
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('career.index', compact('activities'));
    }

    /**
     * Display the specified internship position
     */
    public function show($id)
    {
        $activity = Activity::with(['division', 'mentor'])
            ->where('status', 'open')
            ->findOrFail($id);
        
        return view('career.detail', compact('activity'));
    }
}
