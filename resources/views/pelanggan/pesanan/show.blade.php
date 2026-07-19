<x-layout :title="$title">

    <div class="max-w-5xl mx-auto px-4 py-10">

        <div class="mb-6">
            <a href="{{ route('pelanggan.pesanan') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

                Kembali

            </a>
        </div>

        <h1 class="text-3xl font-bold mb-8 text-center">
            Detail Pesanan
        </h1>

        @if(session('success'))

            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-700">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white rounded-xl shadow p-6">

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-500">Kode Penyewaan</p>
                    <p class="font-semibold">{{ $penyewaan->kode_penyewaan }}</p>
                </div>

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

                <div>
                    <p class="text-gray-500">Status</p>

                    <div class="mt-1">
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $penyewaan->status }}
                        </span>
                    </div>
                </div>


                <div>
                    <p class="text-gray-500">Tanggal Acara</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($penyewaan->tanggal_acara)->format('d M Y') }}
                    </p>
                </div>

                
                <div>
                    <p class="text-gray-500">Total Pembayaran</p>
                    <p class="font-bold text-xl">
                        Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Selesai</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}
                    </p>
                </div>
            </div>

            <hr class="my-6">

            <h2 class="text-xl font-semibold mb-4">
                Detail Layanan
            </h2>

            <table class="w-full border">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Layanan</th>
                        <th class="p-3 text-center">Qty</th>
                        <th class="p-3 text-right">Harga</th>
                        <th class="p-3 text-right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($penyewaan->detailPenyewaans as $detail)

                        <tr class="border-t">

                            <td class="p-3">
                                {{ $detail->nama_layanan }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $detail->qty }}
                            </td>

                            <td class="p-3 text-right">
                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                            </td>

                            <td class="p-3 text-right">
                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            {{-- Card Bukti Pembayaran --}}
            {{-- Bukti Pembayaran --}}
            <div class="mt-8 border-t pt-8">

                <h2 class="text-xl font-semibold mb-6">
                    Bukti Pembayaran
                </h2>

                @if($penyewaan->status == 'Menunggu Pembayaran' || $penyewaan->status == 'Ditolak')

                    <form action="{{ route('pelanggan.pembayaran.store', $penyewaan->id_penyewaan) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="flex gap-8 items-start">

                            {{-- Preview --}}
                            <div class="w-44">

                                <div id="placeholder"
                                    class="w-44 h-44 border rounded-lg border-dashed flex items-center justify-center text-gray-400 text-sm">

                                    Preview

                                </div>

                                <img id="preview" src="" alt="Preview Bukti"
                                    class="hidden w-40 h-40 object-cover rounded-lg border border-gray-300 shadow-sm cursor-pointer transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl">

                            </div>

                            {{-- Form --}}
                            <div class="flex-1">

                                <label class="block mb-2 text-sm font-medium">
                                    Pilih Bukti Pembayaran
                                </label>

                                <input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png"
                                    required class="hidden">

                                <div class="flex items-center gap-3">

                                    <label for="bukti_pembayaran"
                                        class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                                        Pilih Bukti

                                    </label>

                                </div>

                                <p class="text-sm text-gray-500 mt-2">
                                    Format yang didukung: JPG, JPEG, PNG (maksimal 2 MB).
                                </p>

                            </div>

                        </div>

                        <div class="flex justify-end gap-3 mt-8">

                            

                            <button type="submit" class="px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">

                                Upload Bukti

                            </button>

                        </div>

                    </form>

                @endif

                @if($penyewaan->status == 'Ditolak')

                    @if($penyewaan->pembayaran?->catatan_admin)
                        <div class="mt-6 rounded-lg border border-red-300 bg-red-50 p-4">
                            <h3 class="font-semibold text-red-700">
                                Catatan Admin
                            </h3>

                            <p class="mt-2 text-gray-700">
                                {{ $penyewaan->pembayaran->catatan_admin }}
                            </p>
                        </div>
                    @endif


                @elseif($penyewaan->status == 'Menunggu Verifikasi')

                    <div class="rounded-lg bg-yellow-100 border border-yellow-300 p-4 text-yellow-700">
                        Bukti pembayaran telah dikirim dan sedang menunggu verifikasi admin.
                    </div>

                @elseif($penyewaan->status == 'Disetujui')

                    <div class="rounded-lg bg-green-100 border border-green-300 p-4 text-green-700">
                        Pembayaran telah diverifikasi dan disetujui.
                    </div>

                @endif

            </div>

        </div>

    </div>

    <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

        <div class="relative">

            <button type="button" id="closeModal" class="absolute -top-10 right-0 text-white text-4xl">

                &times;

            </button>

            <img id="modalImage" class="max-w-[90vw] max-h-[90vh] rounded-lg">

        </div>

    </div>

    <script>
        const input = document.getElementById('bukti_pembayaran');
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');
        const removeButton = document.getElementById('removeImage');

        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeModal = document.getElementById('closeModal');

        input.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {

                preview.src = e.target.result;

                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');

                removeButton.classList.remove('hidden');

            };

            reader.readAsDataURL(file);

        });

        // Preview jadi besar
        preview.addEventListener('click', function () {

            if (!preview.src) return;

            modalImage.src = preview.src;

            imageModal.classList.remove('hidden');
            imageModal.classList.add('flex');

        });

        // Tutup modal
        closeModal.addEventListener('click', function () {

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

        // Hapus preview
        removeButton.addEventListener('click', function () {

            input.value = '';

            preview.src = '';

            preview.classList.add('hidden');

            placeholder.classList.remove('hidden');

            removeButton.classList.add('hidden');

        });
    </script>
</x-layout>