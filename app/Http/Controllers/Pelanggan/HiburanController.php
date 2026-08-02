<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Hiburan;
use Illuminate\Http\Request;

class HiburanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $hiburans = Hiburan::with('images')
                    ->latest()
                    ->get();

    return view('pelanggan.hiburan.index', [
        'title' => 'Hiburan',
        'hiburans' => $hiburans
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
    $hiburan = Hiburan::with('images')
        ->where('slug', $slug)
        ->firstOrFail();

    return view('pelanggan.hiburan.show', [
        'title' => 'Detail Hiburan',
        'hiburan' => $hiburan
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
