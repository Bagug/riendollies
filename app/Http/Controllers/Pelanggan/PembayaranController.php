<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ],
        [
        'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
        'bukti_pembayaran.image'    => 'File yang diunggah harus berupa gambar.',
        'bukti_pembayaran.mimes'    => 'Format file harus JPG, JPEG, atau PNG.',
        'bukti_pembayaran.max'      => 'Ukuran file maksimal 5 MB.',
    ]);

        $penyewaan = Penyewaan::where(
            'id_pelanggan',
            session('id_pelanggan')
        )->findOrFail($id);

        $path = $request->file('bukti_pembayaran')
            ->store('pembayaran', 'public');

        Pembayaran::updateOrCreate(
            [
                'id_penyewaan' => $penyewaan->id_penyewaan,
            ],
            [
                'tanggal_pembayaran' => now(),
                'bukti_pembayaran' => $path,
                'status_verifikasi' => 'Menunggu Verifikasi',
                'catatan_admin' => null,
            ]
        );

        $penyewaan->update([
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()
            ->route('pelanggan.pesanan.show', $penyewaan->id_penyewaan)
            ->with('success', 'Bukti pembayaran berhasil diupload.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
