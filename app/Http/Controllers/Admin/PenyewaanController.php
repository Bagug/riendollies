<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index()
    {
        $penyewaans = Penyewaan::with('pelanggan')
            ->latest()
            ->paginate(5);

        return view('admin.penyewaan.index', compact('penyewaans'));
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with([
            'pelanggan',
            'detailPenyewaans',
            'pembayaran',
        ])->findOrFail($id);

        return view('admin.penyewaan.show', compact('penyewaan'));
    }

    public function setujui(Penyewaan $penyewaan)
    {
        if (!$penyewaan->pembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $penyewaan->update([
            'status' => 'Disetujui',
        ]);

        $penyewaan->pembayaran->update([
            'status_verifikasi' => 'Disetujui',
            'catatan_admin' => null,
        ]);

        return redirect()
            ->route('admin.penyewaan.show', $penyewaan->id_penyewaan)
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:255',
        ]);

        $penyewaan = Penyewaan::with('pembayaran')
            ->findOrFail($id);

        if (!$penyewaan->pembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $penyewaan->update([
            'status' => 'Ditolak',
        ]);

        $penyewaan->pembayaran->update([
            'status_verifikasi' => 'Ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()
            ->route('admin.penyewaan.show', $penyewaan->id_penyewaan)
            ->with('success', 'Pembayaran berhasil ditolak.');
    }

    public function selesai(Penyewaan $penyewaan)
    {
        $penyewaan->update([
            'status' => 'Selesai',
        ]);

        return redirect()
            ->route('admin.penyewaan.show', $penyewaan->id_penyewaan)
            ->with('success', 'Penyewaan berhasil diselesaikan.');
    }
}
