<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Perawatan;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $perawatans = Perawatan::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.perawatan.index', [
        'title' => 'Perawatan',
        'perawatans' => $perawatans
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
    $perawatan = Perawatan::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.perawatan.show', [
        'title' => 'Detail Perawatan',
        'perawatan' => $perawatan
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
