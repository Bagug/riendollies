<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $photographers = Photographer::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.photographer.index', [
        'title' => 'Photographer',
        'photographers' => $photographers
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
    $photographer = Photographer::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.photographer.show', [
        'title' => 'Detail Photographer',
        'photographer' => $photographer
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
