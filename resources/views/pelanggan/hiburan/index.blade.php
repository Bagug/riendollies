<x-layout>

    <x-slot:title> Hiburan </x-slot:title>

    <div class="max-w-7xl mx-auto py-10">

        <div class="relative flex items-center mb-8">

            <!-- Tombol Kembali -->
            <a href="/layanan"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>

                Kembali
            </a>


            <h1 class="absolute left-1/2 -translate-x-1/2 text-3xl font-bold">
                Hiburan
            </h1>

        </div>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($hiburans as $hiburan)


                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

                    {{-- Gambar --}}
                    @if($hiburan->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $hiburan->images->first()->image) }}"
                            alt="{{ $hiburan->nama_hiburan }}" class="w-full h-56 object-cover">

                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="w-full h-56 object-cover">
                    @endif

                    <div class="p-5 flex flex-col h-full">

                        {{-- Nama --}}
                        <h2 class="text-xl font-bold text-gray-800 text-center">
                            {{ $hiburan->nama_hiburan }}
                        </h2>

                        {{-- Deskripsi --}}
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed text-center h-12">
                            {{ Str::limit($hiburan->deskripsi, 80) }}
                        </p>

                        {{-- Harga --}}
                        <p class="mt-4 text-2xl font-bold text-green-600 text-center">
                            Rp {{ number_format($hiburan->harga, 0, ',', '.') }}
                        </p>

                        {{-- Tombol --}}
                        <a href="{{ route('pelanggan.hiburan.show', $hiburan->slug) }}"
                            class="mt-5 inline-block w-full rounded-lg bg-blue-600 py-2 text-center font-semibold text-white hover:bg-blue-700 transition">

                            Lihat Detail

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-layout>