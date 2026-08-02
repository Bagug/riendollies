<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\WeddingOrganizer;
use Illuminate\Http\Request;

class WeddingOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $weddingOrganizers = WeddingOrganizer::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.wedding-organizer.index', [
        'title' => 'WeddingOrganizer',
        'weddingOrganizers' => $weddingOrganizers
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
{
    $weddingOrganizer = WeddingOrganizer::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.wedding-organizer.show', [
        'title' => 'Detail WeddingOrganizer',
        'weddingOrganizer' => $weddingOrganizer
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
