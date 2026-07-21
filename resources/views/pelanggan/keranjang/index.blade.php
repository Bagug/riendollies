<x-layout>
    <x-slot:title>
        Keranjang
    </x-slot:title>

    <div class="max-w-6xl mx-auto py-10">

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
                Keranjang Saya
            </h1>

        </div>


        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-700 p-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">
                {{ session('error') }}
            </div>
        @endif

        @forelse($cart as $item)

            <div class="border rounded-xl p-5 mb-4 flex justify-between items-center">

                <div>
                    <h2 class="font-semibold text-lg">
                        {{ $item['nama_layanan'] }}
                    </h2>

                    <p class="text-gray-500">
                        {{ ucfirst($item['jenis_layanan']) }}
                    </p>
                </div>

                <div class="text-right">

                    <p class="font-bold text-gray-600 mb-3">
                        Rp {{ number_format($item['harga'], 0, ',', '.') }}
                    </p>

                    <form action="{{ route('pelanggan.cart.remove', [$item['jenis_layanan'], $item['id_layanan']]) }}"
                        method="POST" onsubmit="return confirm('Hapus layanan ini dari keranjang?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm">
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

            \

        @empty

            <div class="border rounded-xl p-8 text-center text-gray-500">

                Keranjang masih kosong.

            </div>



        @endforelse

        @if(count($cart))

            <div class="mt-8 border-t pt-6 flex justify-between items-center">

                <div>

                    <p class="text-lg font-semibold">
                        Total
                    </p>

                    <p class="text-2xl font-bold text-gray-600">
                        Rp {{ number_format(collect($cart)->sum('harga'), 0, ',', '.') }}
                    </p>

                </div>

                <a href="{{ route('pelanggan.checkout') }}"
                    class="rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">

                    Checkout

                </a>

            </div>

        @endif


    </div>
</x-layout>