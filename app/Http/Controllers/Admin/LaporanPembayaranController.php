<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Pembayaran::with([
            'penyewaan.pelanggan'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search) {
            $query->whereHas('penyewaan', function ($q) use ($search) {

                $q->where('kode_penyewaan', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', function ($pelanggan) use ($search) {

                        $pelanggan->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Periode
        |--------------------------------------------------------------------------
        */

        if ($start_date && $end_date) {
            $query->whereBetween(
                'tanggal_pembayaran',
                [$start_date, $end_date]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Data
        |--------------------------------------------------------------------------
        */

        $pembayarans = (clone $query)
            ->latest('tanggal_pembayaran')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Ringkasan (Mengikuti Filter)
        |--------------------------------------------------------------------------
        */

        $ringkasan = (clone $query)->get();

        $totalPembayaran = $ringkasan->count();

        $disetujui = $ringkasan
            ->where('status_verifikasi', 'Disetujui')
            ->count();

        $menunggu = $ringkasan
            ->where('status_verifikasi', 'Menunggu Verifikasi')
            ->count();

        $ditolak = $ringkasan
            ->where('status_verifikasi', 'Ditolak')
            ->count();

        $belumSelesai = Pembayaran::where('status_verifikasi', 'Disetujui')
            ->whereHas('penyewaan', function ($query) {
                $query->where('status', 'Disetujui');
            })
            ->count();

        $totalPendapatan = $ringkasan
            ->where('status_verifikasi', 'Disetujui')
            ->sum(function ($item) {

                return $item->penyewaan->total_harga;
            });

        return view(
            'admin.laporan.pembayaran.index',
            compact(
                'pembayarans',
                'totalPembayaran',
                'disetujui',
                'menunggu',
                'ditolak',
                'belumSelesai',
                'totalPendapatan',
                'search',
                'start_date',
                'end_date'
            )
        );
    }

    public function pdf(Request $request)
    {
        $query = Pembayaran::with([
            'penyewaan.pelanggan'
        ]);

        // Search
        if ($request->search) {

            $query->whereHas('penyewaan', function ($q) use ($request) {

                $q->where('kode_penyewaan', 'like', "%{$request->search}%")
                    ->orWhereHas('pelanggan', function ($pelanggan) use ($request) {

                        $pelanggan->where('nama', 'like', "%{$request->search}%");
                    });
            });
        }

        // Filter tanggal
        if ($request->start_date && $request->end_date) {

            $query->whereBetween(
                'tanggal_pembayaran',
                [$request->start_date, $request->end_date]
            );
        }

        $pembayarans = $query
            ->latest('tanggal_pembayaran')
            ->get();

        $totalPendapatan = $pembayarans
            ->where('status_verifikasi', 'Disetujui')
            ->sum(function ($item) {

                return $item->penyewaan->total_harga;
            });

        $pdf = Pdf::loadView(
            'admin.laporan.pembayaran.pdf',
            [
                'pembayarans' => $pembayarans,
                'totalPendapatan' => $totalPendapatan,
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->stream('laporan.pembayaran.pdf');
    }
}
