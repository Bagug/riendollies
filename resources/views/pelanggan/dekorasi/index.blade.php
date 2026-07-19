<x-layout>

    <x-slot:title> Dekorasi </x-slot:title>

    <div class="max-w-7xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-8">
            Dekorasi Pernikahan
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($dekorasis as $dekorasi)

                <div class="bg-white rounded-lg shadow p-5">

                    <h2 class="font-bold text-xl">
                        {{ $dekorasi->nama_dekorasi }}
                    </h2>

                    <p class="text-blue-600 font-semibold">
                        Rp {{ number_format($dekorasi->harga, 0, ',', '.') }}
                    </p>

                    <a href="{{ route('pelanggan.dekorasi.show', $dekorasi->slug) }}">
                        Detail
                    </a>

                </div>

            @endforeach

        </div>

    </div>

</x-layout>