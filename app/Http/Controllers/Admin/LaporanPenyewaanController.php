<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::with([
            'pelanggan',
            'detailPenyewaans',
            'pembayaran'
        ])->where('status', 'Selesai');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_penyewaan', 'like', "%{$search}%")

                    ->orWhereHas('pelanggan', function ($pelanggan) use ($search) {

                        $pelanggan->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter tanggal acara
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_acara', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_acara', '<=', $request->end_date);
        }

        $penyewaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistik mengikuti hasil filter
        $statistik = clone $query;

        $jumlahTransaksi = $statistik->count();

        $totalPendapatan = (clone $query)->sum('total_harga');

        return view('admin.laporan.penyewaan.index', compact(
            'penyewaans',
            'jumlahTransaksi',
            'totalPendapatan'
        ));
    }

    public function print(Request $request)
    {
        Carbon::setLocale('id');
        $query = Penyewaan::with([
            'pelanggan',
            'detailPenyewaans',
            'pembayaran'
        ])->where('status', 'Selesai');

        // Filter pencarian
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('kode_penyewaan', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', function ($pelanggan) use ($search) {

                        $pelanggan->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_acara', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_acara', '<=', $request->end_date);
        }

        $penyewaans = $query
            ->orderBy('tanggal_acara', 'desc')
            ->get();

        $totalPendapatan = $penyewaans->sum('total_harga');

        $pdf = Pdf::loadView('admin.laporan.penyewaan.pdf', [
            'penyewaans'      => $penyewaans,
            'totalPendapatan' => $totalPendapatan,
            'startDate'       => $request->start_date,
            'endDate'         => $request->end_date,
        ]);

        $pdf->setPaper('A4', 'landscape');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->format('d-m-Y');
            $end   = Carbon::parse($request->end_date)->format('d-m-Y');

            $namaFile = "lap_penyewaan_{$start}_sd_{$end}.pdf";
        } else {
            $namaFile = "lap_penyewaan_semua_periode.pdf";
        }

        return $pdf->stream($namaFile);
    }
}
