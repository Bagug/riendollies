<x-admin-layout>

    <x-slot:title>
        Laporan Pembayaran
    </x-slot:title>

    {{-- Card Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5">

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">Jumlah Pembayaran</h5>

            <h2 class="text-3xl font-bold">
                {{ $totalPembayaran }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">Disetujui</h5>

            <h2 class="text-3xl font-bold text-green-600">
                {{ $disetujui }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">
                Menunggu Verifikasi
            </h5>

            <h2 class="text-3xl font-bold text-yellow-500">
                {{ $menunggu }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">Ditolak</h5>

            <h2 class="text-3xl font-bold text-red-600">
                {{ $ditolak }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">

            <h5 class="text-gray-500 text-sm">
                Belum Selesai
            </h5>

            <h2 class="text-3xl font-bold text-orange-500">
                {{ $belumSelesai }}
            </h2>

        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <h5 class="text-gray-500 text-sm">
                Total Pembayaran Terverifikasi
            </h5>

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

                <a href="{{ route('admin.laporan.pembayaran') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Reset
                </a>

                <a href="{{ route('admin.laporan.pembayaran.pdf', request()->query()) }}" target="_blank"
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

            @if($pembayarans->count())

                <p class="text-sm text-gray-500">

                    Menampilkan
                    <span class="font-semibold">{{ $pembayarans->firstItem() }}</span>
                    -
                    <span class="font-semibold">{{ $pembayarans->lastItem() }}</span>
                    dari total
                    <span class="font-semibold">{{ $pembayarans->total() }}</span>
                    Data pembayaran

                </p>

            @else

                <p class="text-sm text-gray-500">

                    Tidak ada data pembayaran yang ditemukan.

                </p>

            @endif

        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-3 text-center font-semibold">No</th>
                        <th class="px-4 py-3 text-center font-semibold">Kode Penyewaan</th>
                        <th class="px-4 py-3 text-center font-semibold">Nama Pelanggan</th>
                        <th class="px-4 py-3 text-center font-semibold">Tanggal Pembayaran</th>
                        <th class="px-4 py-3 text-center font-semibold">Total Pembayaran</th>
                        <th class="px-4 py-3 text-center font-semibold">Status Pembayaran</th>
                        <th class="px-4 py-3 text-center font-semibold">Status Penyewaan</th>
                        <th class="px-4 py-3 text-center font-semibold">Bukti Pembayaran</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pembayarans as $pembayaran)

                        <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">

                            <td class="px-4 py-4 text-center">
                                {{ $pembayarans->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-4 font-mono text-center">
                                {{ $pembayaran->penyewaan->kode_penyewaan }}
                            </td>

                            <td class="px-4 py-4 text-center">
                                {{ $pembayaran->penyewaan->pelanggan->nama }}
                            </td>


                            <td class="px-4 py-4 text-center">
                                {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-4 text-center font-semibold">
                                Rp {{ number_format($pembayaran->penyewaan->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-4 text-center">

                                @if($pembayaran->status_verifikasi == 'Disetujui')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-blue-300 bg-blue-50 text-blue-700">
                                        Disetujui
                                    </span>

                                @elseif($pembayaran->status_verifikasi == 'Menunggu Verifikasi')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-yellow-300 bg-yellow-50 text-yellow-700">
                                        Menunggu Verifikasi
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-red-300 bg-red-50 text-red-700">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-4 text-center">

                                @if($pembayaran->status_verifikasi == 'Menunggu Verifikasi')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-yellow-300 bg-yellow-50 text-yellow-700">
                                        Menunggu Verifikasi
                                    </span>

                                @elseif($pembayaran->status_verifikasi == 'Ditolak')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-red-300 bg-red-50 text-red-700">
                                        Ditolak
                                    </span>

                                @elseif($pembayaran->penyewaan->status == 'Disetujui')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-yellow-300 bg-yellow-50 text-yellow-700">
                                        Belum Selesai
                                    </span>

                                @elseif($pembayaran->penyewaan->status == 'Selesai')

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-green-300 bg-green-50 text-green-700">
                                        Selesai
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-gray-300 bg-gray-100 text-gray-700">
                                        {{ $pembayaran->penyewaan->status }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-4 text-center">

                                <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                    class="w-16 h-16 rounded-lg object-cover mx-auto cursor-pointer hover:scale-105 transition"
                                    onclick="showImage(this.src)">

                            </td>

                        </tr>

                        
                    @empty

                        <tr>

                            <td colspan="8" class="py-10 text-center text-gray-500">

                                Tidak ada data pembayaran yang ditemukan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $pembayarans->links() }}
    </div>


    {{-- Modal Preview Gambar --}}
    <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-4">

        <div class="relative">

            <button onclick="closeImage()"
                class="absolute -top-3 -right-3 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

            <img id="previewImage" src="" class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl">

        </div>

    </div>

    @push('scripts')
        <script>

            function showImage(src) {
                document.getElementById('previewImage').src = src;

                const modal = document.getElementById('imageModal');

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeImage() {
                const modal = document.getElementById('imageModal');

                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.getElementById('imageModal').addEventListener('click', function (e) {

                if (e.target === this) {
                    closeImage();
                }

            });

            document.addEventListener('keydown', function (e) {

                if (e.key === 'Escape') {
                    closeImage();
                }

            });

        </script>
    @endpush

</x-admin-layout>