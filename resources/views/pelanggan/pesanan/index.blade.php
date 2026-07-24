<x-layout :title="$title">

    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-8 text-center">
            Pesanan Saya
        </h1>

        @if(session('success'))
            <div class="mb-5 rounded-lg bg-green-100 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if($penyewaans->isEmpty())

            <div class="bg-white rounded-xl shadow p-8 text-center">

                <h2 class="text-xl font-semibold mb-2">
                    Belum Ada Pesanan
                </h2>

                <p class="text-gray-500">
                    Silakan lakukan penyewaan terlebih dahulu.
                </p>

            </div>

        @else

            <div class="overflow-x-auto bg-white rounded-xl shadow">

                <table class="w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-5 py-4 text-center">
                                Kode
                            </th>   

                            <th class="px-5 py-4 text-center">
                                Layanan
                            </th>

                            <th class="px-5 py-4 text-center">
                                Tanggal Acara
                            </th>

                            <th class="px-5 py-4 text-center">
                                Total
                            </th>

                            <th class="px-5 py-4 text-center">
                                Status
                            </th>

                            <th class="px-5 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($penyewaans as $penyewaan)

                            <tr class="border-t">

                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    {{ $penyewaan->kode_penyewaan }}
                                </td>

                                <td class="px-5 py-4 text-center">

                                    @foreach($penyewaan->detailPenyewaans as $detail)

                                        {{ $detail->nama_layanan }}

                                        @if(!$loop->last)
                                            ,
                                        @endif

                                    @endforeach

                                </td>

                                <td class="px-5 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($penyewaan->tanggal_acara)->format('d M Y') }}
                                </td>

                                <td class="px-5 py-4 text-center">
                                    Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4 text-center whitespace-nowrap">

                                    @php
                                        $statusClass = match ($penyewaan->status) {

                                            'Menunggu Pembayaran',
                                            'Menunggu Verifikasi' => 'bg-yellow-100 text-yellow-800',

                                            'Disetujui' => 'bg-blue-100 text-blue-800',

                                            'Ditolak' => 'bg-red-100 text-red-800',

                                            'Selesai' => 'bg-green-100 text-green-800',

                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp

                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                        {{ $penyewaan->status }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <a href="{{ route('pelanggan.pesanan.show', $penyewaan->id_penyewaan) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</x-layout>