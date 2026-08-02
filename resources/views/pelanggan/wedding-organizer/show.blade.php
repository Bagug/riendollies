<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-6">
            <a href="{{ route('pelanggan.wedding-organizer.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

                Kembali

            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- Foto Produk --}}
            <div>

                @php
                    $firstImage = $weddingOrganizer->images->first();
                @endphp



                @if($firstImage)

                    <img id="mainImage" src="{{ asset('storage/' . $firstImage->image) }}"
                        class="w-full h-[500px] object-cover rounded-xl shadow-md">

                @else

                    <div class="w-full h-[500px] bg-gray-100 rounded-xl flex items-center justify-center">

                        Tidak ada gambar

                    </div>

                @endif

                {{-- Thumbnail --}}
                @if($weddingOrganizer->images->count())

                    <div class="flex gap-3 mt-4 overflow-x-auto pb-2">

                        @foreach($weddingOrganizer->images as $image)

                            <img src="{{ asset('storage/' . $image->image) }}"
                                data-image="{{ asset('storage/' . $image->image) }}"
                                class="thumbnail w-24 h-24 object-cover rounded-lg border-2 border-transparent cursor-pointer hover:border-blue-600 transition">

                        @endforeach

                    </div>

                @endif

            </div>

            {{-- Informasi --}}
            <div>

                <h1 class="text-4xl font-bold">
                    {{ $weddingOrganizer->nama_wo }}
                </h1>

                <p class="text-3xl font-bold text-blue-700 mt-4">
                    Rp {{ number_format($weddingOrganizer->harga, 0, ',', '.') }}
                </p>

                <div class="mt-6">

                    <span class="font-semibold">
                        Status :
                    </span>

                    @if($weddingOrganizer->status_ketersediaan == 'Tersedia')

                        <span class="text-green-600 font-semibold">
                            🟢 Tersedia
                        </span>

                    @else

                        <span class="text-red-600 font-semibold">
                            🔴 Tidak Tersedia
                        </span>

                    @endif

                </div>

                <div class="mt-8">

                    <h2 class="text-xl font-semibold mb-2">
                        Deskripsi
                    </h2>

                    <p class="text-gray-600 leading-8">
                        {{ $weddingOrganizer->deskripsi }}
                    </p>

                </div>

                <div class="mt-10">

    <div class="mt-10 flex gap-3">

    {{-- Sewa Sekarang --}}
    <a href="{{ route('pelanggan.penyewaan.create', [
        'jenis' => 'wo',
        'slug' => $weddingOrganizer->slug
    ]) }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

        Sewa Sekarang
    </a>

    {{-- Tambah ke Keranjang --}}
    <form action="{{ route('pelanggan.cart.add') }}" method="POST">
        @csrf

        <input type="hidden" name="jenis_layanan" value="wo">
        <input type="hidden" name="id_layanan" value="{{ $weddingOrganizer->id_wo }}">

        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">

        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

            + Keranjang

        </button>
    </form>

</div>

</div>

            </div>

        </div>

    </div>

    <script>

        const mainImage = document.getElementById('mainImage');

        document.querySelectorAll('.thumbnail').forEach(img => {

            img.addEventListener('click', function () {

                mainImage.src = this.dataset.image;

                document.querySelectorAll('.thumbnail').forEach(el => {
                    el.classList.remove('border-blue-600');
                });

                this.classList.add('border-blue-600');

            });

        });

    </script>

</x-layout>