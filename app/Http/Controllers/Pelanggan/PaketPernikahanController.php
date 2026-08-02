<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\PaketPernikahan;
use Illuminate\Http\Request;

class PaketPernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $paketPernikahans = PaketPernikahan::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.paket-pernikahan.index', [
        'title' => 'PaketPernikahan',
        'paketPernikahans' => $paketPernikahans
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
    $paketPernikahan = PaketPernikahan::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.paket-pernikahan.show', [
        'title' => 'Detail PaketPernikahan',
        'paketPernikahan' => $paketPernikahan
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
