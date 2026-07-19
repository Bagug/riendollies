<x-admin-layout>

    <x-slot name="title">
        Detail Penyewaan
    </x-slot>

    <div class="space-y-6">

        <a href="{{ route('admin.penyewaan.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

            </svg>

            Kembali

        </a>

        {{-- Informasi Penyewaan --}}
        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-semibold mb-5">
                Informasi Penyewaan
            </h2>

            <div class="grid grid-cols-2 gap-5">

                <div>
                    <label class="font-semibold text-gray-600">Kode Penyewaan</label>
                    <p>{{ $penyewaan->kode_penyewaan }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Status</label>

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

                    <div class="mt-1">
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $penyewaan->status }}
                        </span>
                    </div>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Tanggal Penyewaan</label>
                    <p>{{ \Carbon\Carbon::parse($penyewaan->tanggal_penyewaan)->format('d-m-Y') }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Tanggal Acara</label>
                    <p>{{ \Carbon\Carbon::parse($penyewaan->tanggal_acara)->format('d-m-Y') }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Tanggal Selesai</label>
                    <p>{{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d-m-Y') }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Total Harga</label>
                    <p>Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</p>
                </div>

            </div>

        </div>

        {{-- Informasi Pelanggan --}}
        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-semibold mb-5">
                Informasi Pelanggan
            </h2>

            <div class="grid grid-cols-2 gap-5">

                <div>
                    <label class="font-semibold text-gray-600">Nama</label>
                    <p>{{ $penyewaan->pelanggan->nama }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Username</label>
                    <p>{{ $penyewaan->pelanggan->username }}</p>
                </div>

                <div>
                    <label class="font-semibold text-gray-600">Email</label>
                    <p>{{ $penyewaan->pelanggan->email }}</p>
                </div>

            </div>

        </div>

        {{-- Detail Layanan --}}
        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-semibold mb-5">
                Detail Layanan
            </h2>

            <table class="min-w-full border">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border p-3">No</th>
                        <th class="border p-3">Jenis</th>
                        <th class="border p-3">Nama Layanan</th>
                        <th class="border p-3">Qty</th>
                        <th class="border p-3">Harga</th>
                        <th class="border p-3">Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($penyewaan->detailPenyewaans as $detail)
                        <tr>

                            <td class="border p-3 text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border p-3 text-center">
                                {{ $detail->jenis_layanan }}
                            </td>

                            <td class="border p-3 text-center">
                                {{ $detail->nama_layanan }}
                            </td>

                            <td class="border p-3 text-center">
                                {{ $detail->qty }}
                            </td>

                            <td class="border p-3 text-center">
                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                            </td>

                            <td class="border p-3 text-center">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- Pembayaran --}}
        <div class="bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-semibold mb-5">
                Pembayaran
            </h2>

            @if ($penyewaan->pembayaran)
                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="font-semibold text-gray-600">
                            Status Verifikasi
                        </label>

                        @php
                            $verifikasiClass = match ($penyewaan->pembayaran->status_verifikasi) {
                                'Menunggu Verifikasi' => 'bg-yellow-100 text-yellow-800',

                                'Disetujui' => 'bg-blue-100 text-blue-800',

                                'Ditolak' => 'bg-red-100 text-red-800',

                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <div class="mt-1">
                            <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $verifikasiClass }}">
                                {{ $penyewaan->pembayaran->status_verifikasi }}
                            </span>
                        </div>

                    </div>

                    <div>

                        <label class="font-semibold text-gray-600">
                            Tanggal Pembayaran
                        </label>

                        <p>
                            {{ \Carbon\Carbon::parse($penyewaan->pembayaran->tanggal_pembayaran)->format('d-m-Y') }}
                        </p>

                    </div>

                </div>

                <div class="mt-6">

                    <label class="font-semibold text-gray-600">
                        Bukti Pembayaran
                    </label>

                    <div class="mt-3">

                        <img id="previewImage" src="{{ asset('storage/' . $penyewaan->pembayaran->bukti_pembayaran) }}"
                            class="w-64 rounded shadow cursor-pointer hover:scale-105 transition">

                    </div>

                </div>
            @else
                <div class="text-red-500">

                    Pelanggan belum mengunggah bukti pembayaran.

                </div>
            @endif

        </div>

        @if ($penyewaan->pembayaran && $penyewaan->pembayaran->status_verifikasi == 'Menunggu Verifikasi')
            <div class="mt-6 flex gap-3">

                <form action="{{ route('admin.penyewaan.setujui', $penyewaan->id_penyewaan) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                        Setujui

                    </button>

                </form>

                <button type="button" onclick="openModal()"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">

                    Tolak Pembayaran

                </button>

            </div>
        @endif

        @if ($penyewaan->status == 'Disetujui')
            <div class="mt-6">

                <form action="{{ route('admin.penyewaan.selesai', $penyewaan->id_penyewaan) }}" method="POST"
                    onsubmit="return confirm('Apakah penyewaan ini sudah selesai?')">

                    @csrf
                    @method('PATCH')

                    <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">

                        Tandai Selesai

                    </button>

                </form>

            </div>
        @endif
    </div>



    <div id="modalTolak" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">

            <h2 class="text-xl font-semibold mb-4">
                Tolak Pembayaran
            </h2>

            <form action="{{ route('admin.penyewaan.tolak', $penyewaan->id_penyewaan) }}" method="POST">

                @csrf
                @method('PATCH')

                <label class="block mb-2 font-medium">
                    Catatan Admin
                </label>

                <textarea name="catatan_admin" rows="4" required class="w-full border rounded-lg p-3"
                    placeholder="Masukkan alasan penolakan..."></textarea>

                <div class="flex justify-end gap-3 mt-5">

                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg">

                        Batal

                    </button>

                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

        <div class="relative">

            <button id="closeModal" type="button" class="absolute -top-10 right-0 text-white text-4xl">

                &times;

            </button>

            <img id="modalImage" class="max-w-[90vw] max-h-[90vh] rounded-lg">

        </div>

    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modalTolak');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modalTolak');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        const previewImage = document.getElementById('previewImage');
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeImageModal = document.getElementById('closeModal');

        if (previewImage) {

            previewImage.addEventListener('click', function () {

                modalImage.src = this.src;

                imageModal.classList.remove('hidden');
                imageModal.classList.add('flex');

            });

        }

        closeImageModal.addEventListener('click', function () {

            imageModal.classList.add('hidden');
            imageModal.classList.remove('flex');

        });

        imageModal.addEventListener('click', function (e) {

            if (e.target === imageModal) {

                imageModal.classList.add('hidden');
                imageModal.classList.remove('flex');

            }

        });

        document.addEventListener('keydown', function (e) {

            if (e.key === 'Escape') {

                imageModal.classList.add('hidden');
                imageModal.classList.remove('flex');

            }

        });
    </script>

</x-admin-layout>