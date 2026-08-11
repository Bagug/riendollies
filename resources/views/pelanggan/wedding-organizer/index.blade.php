<x-layout>

    <x-slot:title> Wedding Organizer </x-slot:title>

    <div class="max-w-7xl mx-auto py-10">

        <div class="relative flex items-center justify-center px-4 py-6">

    {{-- Tombol kembali --}}
    <a href="/layanan"
       class="absolute left-4 flex items-center gap-1 text-gray-700 hover:text-gray-900">
        <span class="text-2xl">‹</span>
        <span class="text-base">Kembali</span>
    </a>

    {{-- Judul --}}
    <h1 class="max-w-[220px] text-center text-3xl font-bold leading-tight text-gray-900 md:max-w-none md:text-4xl">
        Wedding Organizer
    </h1>

</div>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($weddingOrganizers as $weddingOrganizer)


                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

                    {{-- Gambar --}}
                    @if($weddingOrganizer->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $weddingOrganizer->images->first()->image) }}"
                            alt="{{ $weddingOrganizer->nama_wo }}" class="w-full h-56 object-cover">

                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="w-full h-56 object-cover">
                    @endif

                   <div class="p-5 flex flex-col h-full">

                        {{-- Nama --}}
                        <h2 class="text-xl font-bold text-gray-800 text-center">
                            {{ $weddingOrganizer->nama_wo }}
                        </h2>

                        {{-- Deskripsi --}}
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed text-center h-12">
                            {{ Str::limit($weddingOrganizer->deskripsi, 80) }}
                        </p>

                        {{-- Harga --}}
                        <p class="mt-4 text-2xl font-bold text-green-600 text-center">
                            Rp {{ number_format($weddingOrganizer->harga, 0, ',', '.') }}
                        </p>

                        {{-- Tombol --}}
                        <a href="{{ route('pelanggan.wedding-organizer.show', $weddingOrganizer->slug) }}"
                            class="mt-5 inline-block w-full rounded-lg bg-blue-600 py-2 text-center font-semibold text-white hover:bg-blue-700 transition">

                            Lihat Detail

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-layout>