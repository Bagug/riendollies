<x-layout>
    <x-slot:title>
        Keranjang
    </x-slot:title>

    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-8">
            Keranjang Saya
        </h1>

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

                    <p class="font-bold text-pink-600 mb-3">
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

                    <p class="text-2xl font-bold text-pink-600">
                        Rp {{ number_format(collect($cart)->sum('harga'), 0, ',', '.') }}
                    </p>

                </div>

                <a href="{{ route('pelanggan.checkout') }}"
                    class="rounded-lg bg-pink-600 px-6 py-3 text-white hover:bg-pink-700">

                    Checkout

                </a>

            </div>

        @endif


    </div>
</x-layout>