<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('login_pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $penyewaans = Penyewaan::with('detailPenyewaans')
            ->where('id_pelanggan', session('id_pelanggan'))
            ->latest()
            ->get();

        return view('pelanggan.pesanan.index', [
            'title' => 'Pesanan Saya',
            'penyewaans' => $penyewaans
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
    public function show($id)
    {
        if (!session('login_pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $penyewaan = Penyewaan::with([
            'detailPenyewaans',
            'pembayaran'
        ])
            ->where('id_pelanggan', session('id_pelanggan'))
            ->findOrFail($id);

        return view('pelanggan.pesanan.show', [
            'title' => 'Detail Pesanan',
            'penyewaan' => $penyewaan
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
