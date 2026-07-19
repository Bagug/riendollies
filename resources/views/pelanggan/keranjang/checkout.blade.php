<x-layout>

<x-slot:title>
Checkout
</x-slot:title>

<div class="max-w-5xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">
        Checkout Penyewaan
    </h1>

    @foreach($cart as $item)

        <div class="border rounded-xl p-5 mb-4">

            <h2 class="font-semibold">
                {{ $item['nama_layanan'] }}
            </h2>

            <p class="text-gray-500">
                {{ ucfirst($item['jenis_layanan']) }}
            </p>

            <p class="font-bold text-pink-600 mt-2">
                Rp {{ number_format($item['harga'],0,',','.') }}
            </p>

        </div>

    @endforeach

    <div class="mt-6 border-t pt-6">

        <h2 class="text-xl font-bold">

            Total :
            Rp {{ number_format($total,0,',','.') }}

        </h2>

    </div>

</div>

</x-layout>