<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pelanggan;
use App\Models\Penyewaan;
use App\Models\Pembayaran;
use App\Models\Dekorasi;
use App\Models\Makeup;
use App\Models\Pakaian;
use App\Models\WeddingOrganizer;
use App\Models\Photographer;
use App\Models\Hiburan;
use App\Models\Perawatan;
use App\Models\PaketPernikahan;


class DashboardController extends Controller
{
    public function index()
    {

        $totalPenyewaan = Penyewaan::count();

        $menungguPembayaran = Penyewaan::where('status', 'Menunggu Pembayaran')->count();

        $menungguVerifikasi = Pembayaran::where('status', 'Menunggu')->count();

        $disetujui = Penyewaan::where('status', 'Disetujui')->count();

        $ditolak = Penyewaan::where('status', 'Ditolak')->count();

        $selesai = Penyewaan::where('status', 'Selesai')->count();

        $totalPendapatan = Penyewaan::where('status', 'Selesai')
            ->sum('total_harga');

        $latestOrders = Penyewaan::with('pelanggan')
            ->orderBy('tanggal_penyewaan', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPenyewaan',
            'menungguPembayaran',
            'menungguVerifikasi',
            'disetujui',
            'ditolak',
            'selesai',
            'totalPendapatan',
            'latestOrders'
        ));
    }
}
