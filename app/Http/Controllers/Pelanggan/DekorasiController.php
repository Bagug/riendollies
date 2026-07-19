<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Dekorasi;
use Illuminate\Http\Request;

class DekorasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $dekorasis = Dekorasi::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.dekorasi.index', [
        'title' => 'Dekorasi',
        'dekorasis' => $dekorasis
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
    $dekorasi = Dekorasi::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.dekorasi.show', [
        'title' => 'Detail Dekorasi',
        'dekorasi' => $dekorasi
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
