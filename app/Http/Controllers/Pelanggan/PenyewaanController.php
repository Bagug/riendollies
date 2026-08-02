<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Dekorasi;
use App\Models\Hiburan;
use App\Models\Makeup;
use App\Models\Pakaian;
use App\Models\PaketPernikahan;
use App\Models\Perawatan;
use App\Models\Photographer;
use App\Models\WeddingOrganizer;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Support\Str;

class PenyewaanController extends Controller
{
    public function create($jenis, $slug)
    {
        if (!session('login_pelanggan')) {

            session([
                'redirect_after_login' => route('pelanggan.penyewaan.create', [
                    'jenis' => $jenis,
                    'slug'  => $slug,
                ])
            ]);

            return redirect()->route('pelanggan.login');
        }

        $layanan = match ($jenis) {

            'dekorasi' => Dekorasi::where('slug', $slug)->firstOrFail(),

            'wo' => WeddingOrganizer::where('slug', $slug)->firstOrFail(),

            'makeup' => Makeup::where('slug', $slug)->firstOrFail(),

            'pakaian' => Pakaian::where('slug', $slug)->firstOrFail(),

            'perawatan' => Perawatan::where('slug', $slug)->firstOrFail(),

            'hiburan' => Hiburan::where('slug', $slug)->firstOrFail(),

            'photographer' => Photographer::where('slug', $slug)->firstOrFail(),

            'paket' => PaketPernikahan::where('slug', $slug)->firstOrFail(),

            default => abort(404),
        };

        $namaLayanan = match ($jenis) {
            'dekorasi'     => $layanan->nama_dekorasi,
            'wo'           => $layanan->nama_wo,
            'makeup'       => $layanan->nama_makeup,
            'pakaian'      => $layanan->nama_pakaian,
            'perawatan'    => $layanan->nama_perawatan,
            'hiburan'      => $layanan->nama_hiburan,
            'photographer' => $layanan->nama_photographer,
            'paket'        => $layanan->nama_paket,
        };

        $harga = $layanan->harga;

        $bookedDates = DetailPenyewaan::where('jenis_layanan', $jenis)
            ->where('id_layanan', $layanan->getKey())
            ->whereHas('penyewaan', function ($query) {
                $query->whereIn('status', [
                    'Menunggu Pembayaran',
                    'Menunggu Verifikasi',
                    'Disetujui',
                ]);
            })
            ->with('penyewaan')
            ->get()
            ->map(function ($detail) {
                return [
                    'from' => $detail->penyewaan->tanggal_acara,
                    'to'   => $detail->penyewaan->tanggal_selesai,
                ];
            })
            ->values();

        $routeKembali = match ($jenis) {
            'dekorasi'     => route('pelanggan.dekorasi.show', $layanan->slug),
            'wo'           => route('pelanggan.wedding-organizer.show', $layanan->slug),
            'makeup'       => route('pelanggan.makeup.show', $layanan->slug),
            'pakaian'      => route('pelanggan.pakaian.show', $layanan->slug),
            'perawatan'    => route('pelanggan.perawatan.show', $layanan->slug),
            'hiburan'      => route('pelanggan.hiburan.show', $layanan->slug),
            'photographer' => route('pelanggan.photographer.show', $layanan->slug),
            'paket'        => route('pelanggan.paket-pernikahan.show', $layanan->slug),
        };

        return view('pelanggan.penyewaan.create', compact(
            'layanan',
            'jenis',
            'namaLayanan',
            'harga',
            'bookedDates',
            'routeKembali'
        ))->with('isCart', false);
    }

    public function store(Request $request)
    {
        if (!session('login_pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $request->validate([
            'tanggal_acara'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_acara',
            'alamat_acara' => 'required|string',
        ],
        [
        'tanggal_acara.required'   => 'Silakan pilih tanggal acara.',
        'tanggal_acara.after_or_equal' => 'Tanggal acara tidak boleh kurang dari hari ini.',

        'tanggal_selesai.required' => 'Silakan pilih selesai acara.',
        'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal acara.',

        'alamat_acara.required'    => 'Alamat acara wajib diisi.',
    ]);

        $isCart = $request->boolean('is_cart');
        $cart = session('cart', []);

        if ($isCart) {

            $cart = session('cart');

            foreach ($cart as $item) {

                $jadwalBentrok = DetailPenyewaan::where('id_layanan', $item['id_layanan'])
                    ->where('jenis_layanan', $item['jenis_layanan'])
                    ->whereHas('penyewaan', function ($query) use ($request) {
                        $query->whereIn('status', [
                            'Menunggu Pembayaran',
                            'Menunggu Verifikasi',
                            'Disetujui',
                        ])
                            ->where('tanggal_acara', '<=', $request->tanggal_selesai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_acara);
                    })
                    ->exists();

                if ($jadwalBentrok) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'tanggal_acara' => $item['nama_layanan'] . ' tidak tersedia pada rentang tanggal tersebut.'
                        ]);
                }
            }

            $total = collect($cart)->sum('harga');
        } else {

            $request->validate([
                'jenis_layanan' => 'required',
                'id_layanan'    => 'required',
            ]);

            $jadwalBentrok = DetailPenyewaan::where('id_layanan', $request->id_layanan)
                ->where('jenis_layanan', $request->jenis_layanan)
                ->whereHas('penyewaan', function ($query) use ($request) {
                    $query->whereIn('status', [
                        'Menunggu Pembayaran',
                        'Menunggu Verifikasi',
                        'Disetujui',
                    ])
                        ->where('tanggal_acara', '<=', $request->tanggal_selesai)
                        ->where('tanggal_selesai', '>=', $request->tanggal_acara);
                })
                ->exists();

            if ($jadwalBentrok) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'tanggal_acara' => 'Layanan tidak tersedia pada rentang tanggal tersebut. Silakan pilih tanggal lain.'
                    ]);
            }

            $layanan = $this->getLayanan(
                $request->jenis_layanan,
                $request->id_layanan
            );

            $total = $layanan->harga;
        }

        $penyewaan = Penyewaan::create([
            'id_pelanggan'      => session('id_pelanggan'),
            'kode_penyewaan' => 'SW-' . now()->format('YmdHis') . rand(100, 999),
            'tanggal_penyewaan' => now()->toDateString(),
            'tanggal_acara'     => $request->tanggal_acara,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'alamat_acara'      => $request->alamat_acara,
            'total_harga'       => $total,
            'status'            => 'Menunggu Pembayaran',
        ]);

        if ($isCart) {

            foreach ($cart as $item) {

                DetailPenyewaan::create([
                    'id_penyewaan'  => $penyewaan->id_penyewaan,
                    'id_layanan'    => $item['id_layanan'],
                    'jenis_layanan' => $item['jenis_layanan'],
                    'nama_layanan'  => $item['nama_layanan'],
                    'harga'         => $item['harga'],
                    'qty'           => 1,
                    'subtotal'      => $item['harga'],
                ]);
            }

            session()->forget('cart');
        } else {

            $namaLayanan = $this->getNamaLayanan(
                $request->jenis_layanan,
                $layanan
            );

            DetailPenyewaan::create([
                'id_penyewaan'  => $penyewaan->id_penyewaan,
                'id_layanan'    => $request->id_layanan,
                'jenis_layanan' => $request->jenis_layanan,
                'nama_layanan'  => $namaLayanan,
                'harga'         => $layanan->harga,
                'qty'           => 1,
                'subtotal'      => $layanan->harga,
            ]);
        }

        return redirect()
            ->route('pelanggan.pesanan')
            ->with('success', 'Penyewaan berhasil dibuat.');
    }

    public function addCart(Request $request)
    {
        if (!session('login_pelanggan')) {

    session([
    'redirect_after_login' => $request->redirect_url,
]);

    return redirect()->route('pelanggan.login');
}

        $request->validate([
            'jenis_layanan' => 'required',
            'id_layanan' => 'required',
        ]);

        $layanan = $this->getLayanan(
            $request->jenis_layanan,
            $request->id_layanan
        );

        $namaLayanan = $this->getNamaLayanan(
            $request->jenis_layanan,
            $layanan
        );

        $cart = session()->get('cart', []);

        foreach ($cart as $item) {

            if (
                $item['jenis_layanan'] == $request->jenis_layanan &&
                $item['id_layanan'] == $request->id_layanan
            ) {

                return redirect()
                    ->route('pelanggan.cart')
                    ->with(
                        'error',
                        'Layanan sudah ada di keranjang.'
                    );
            }
        }

        $cart[] = [
            'jenis_layanan' => $request->jenis_layanan,
            'id_layanan'    => $request->id_layanan,
            'nama_layanan'  => $namaLayanan,
            'harga'         => $layanan->harga,
            'slug'          => $layanan->slug,
        ];

        session()->put('cart', $cart);

        return redirect()
            ->route('pelanggan.cart')
            ->with(
                'success',
                'Layanan berhasil ditambahkan ke keranjang.'
            );
    }

    public function cart()
    {
        if (!session('login_pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $cart = session()->get('cart', []);

        return view('pelanggan.keranjang.index', compact('cart'));
    }

    private function getLayanan($jenis, $id)
    {
        return match ($jenis) {
            'dekorasi'     => Dekorasi::findOrFail($id),
            'wo'           => WeddingOrganizer::findOrFail($id),
            'makeup'       => Makeup::findOrFail($id),
            'pakaian'      => Pakaian::findOrFail($id),
            'perawatan'    => Perawatan::findOrFail($id),
            'hiburan'      => Hiburan::findOrFail($id),
            'photographer' => Photographer::findOrFail($id),
            'paket'        => PaketPernikahan::findOrFail($id),

            default => abort(404),
        };
    }

    private function getNamaLayanan($jenis, $layanan)
    {
        return match ($jenis) {
            'dekorasi'     => $layanan->nama_dekorasi,
            'wo'           => $layanan->nama_wo,
            'makeup'       => $layanan->nama_makeup,
            'pakaian'      => $layanan->nama_pakaian,
            'perawatan'    => $layanan->nama_perawatan,
            'hiburan'      => $layanan->nama_hiburan,
            'photographer' => $layanan->nama_photographer,
            'paket'        => $layanan->nama_paket,
        };
    }

    public function removeCart($jenis, $id)
    {
        $cart = session('cart', []);

        $cart = array_filter($cart, function ($item) use ($jenis, $id) {
            return !(
                $item['jenis_layanan'] == $jenis &&
                $item['id_layanan'] == $id
            );
        });

        session()->put('cart', array_values($cart));

        return back()->with('success', 'Layanan berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        if (!session('login_pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('pelanggan.cart')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = collect($cart)->sum('harga');

        $bookedDates = [];

        foreach ($cart as $item) {

            $details = DetailPenyewaan::where('jenis_layanan', $item['jenis_layanan'])
                ->where('id_layanan', $item['id_layanan'])
                ->with('penyewaan')
                ->get();

            foreach ($details as $detail) {

                if (!$detail->penyewaan) {
                    continue;
                }

                $bookedDates[] = [
                    'from' => $detail->penyewaan->tanggal_acara,
                    'to'   => $detail->penyewaan->tanggal_selesai,
                ];
            }
        }

        return view('pelanggan.penyewaan.create', [
            'cart'         => $cart,
            'total'        => $total,
            'bookedDates'  => $bookedDates,
            'isCart'       => true,
            'routeKembali' => route('pelanggan.cart'),
        ]);
    }
}
