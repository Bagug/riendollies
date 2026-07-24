<x-admin-layout>

    <x-slot:title>
        Laporan Penyewaan
    </x-slot:title>

    {{-- Card Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">Jumlah Transaksi</h5>
            <h2 class="text-3xl font-bold">
                {{ $jumlahTransaksi }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5 text-left">
            <h5 class="text-gray-500 text-sm">Total Pendapatan</h5>
            <h2 class="text-3xl font-bold">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h2>
        </div>

    </div>


    {{-- Card Laporan --}}
    <div class="bg-white rounded-xl shadow p-5 mt-6">

        {{-- Filter --}}
        <form method="GET" class="flex flex-wrap items-end justify-between gap-4">

            <div class="flex flex-wrap items-end gap-4">

                {{-- Tanggal Awal --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal Awal
                    </label>

                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="border rounded-lg px-3 py-2">
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal Akhir
                    </label>

                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="border rounded-lg px-3 py-2">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tampilkan
                </button>

                <a href="{{ route('admin.laporan.penyewaan') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Reset
                </a>

                <a  href="{{ route('admin.laporan.penyewaan.pdf', request()->query()) }}"
                target="_blank"
                    class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-5 h-5">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 7.5V4.875c0-.621.504-1.125 1.125-1.125h8.25c.621 0 1.125.504 1.125 1.125V7.5m-10.5 9.75h10.5m-10.5 0A2.25 2.25 0 0 1 4.5 15V9.75A2.25 2.25 0 0 1 6.75 7.5h10.5A2.25 2.25 0 0 1 19.5 9.75V15a2.25 2.25 0 0 1-2.25 2.25m-10.5 0v2.25m10.5-2.25v2.25" />

                    </svg>

                    <span>Cetak PDF</span>

                </a>

            </div>

            {{-- Search --}}
            <div class="relative">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 5.5 5.5a7.5 7.5 0 0 0 11.15 11.15Z" />

                </svg>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kode penyewaan atau nama pelanggan..." class="w-80 rounded-lg border border-gray-300 pl-10 pr-3 py-2
        placeholder:text-gray-400
        focus:border-blue-500
        focus:ring-2
        focus:ring-blue-200">

            </div>

        </form>

        {{-- Info Data --}}
        <div class="border-t mt-6 pt-4 mb-4">

            @if($penyewaans->count())

                <p class="text-sm text-gray-500">

                    Menampilkan
                    <span class="font-semibold">{{ $penyewaans->firstItem() }}</span>
                    -
                    <span class="font-semibold">{{ $penyewaans->lastItem() }}</span>
                    dari total
                    <span class="font-semibold">{{ $penyewaans->total() }}</span>
                    transaksi penyewaan yang telah selesai.

                </p>

            @else

                <p class="text-sm text-gray-500">

                    Tidak ada transaksi penyewaan yang ditemukan.

                </p>

            @endif

        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-3 text-center font-semibold">No</th>
                        <th class="px-4 py-3 text-center font-semibold">Kode</th>
                        <th class="px-4 py-3 text-center font-semibold">Pelanggan</th>
                        <th class="px-4 py-3 text-center font-semibold">Layanan</th>
                        <th class="px-4 py-3 text-center font-semibold">Tanggal Acara</th>
                        <th class="px-4 py-3 text-center font-semibold">Total</th>
                        <th class="px-4 py-3 text-center font-semibold">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($penyewaans as $penyewaan)

                        <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">

                            <td class="px-4 py-4 text-center">
                                {{ $penyewaans->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-4 font-mono text-center">
                                {{ $penyewaan->kode_penyewaan }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ $penyewaan->pelanggan->nama }}
                            </td>

                            <td class="px-4 py-4">
                                @foreach($penyewaan->detailPenyewaans as $detail)
                                    <div>• {{ $detail->nama_layanan }}</div>
                                @endforeach
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ \Carbon\Carbon::parse($penyewaan->tanggal_acara)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-4 text-center font-semibold">
                                Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-4 text-center">

                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-green-300 bg-green-50 text-green-700">

                                    {{ $penyewaan->status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="py-10 text-center text-gray-500">

                                Tidak ada data penyewaan yang ditemukan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $penyewaans->links() }}
    </div>


</x-admin-layout>