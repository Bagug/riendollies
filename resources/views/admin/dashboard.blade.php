<x-admin-layout>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Dashboard Admin
        </h1>

        <p class="mt-2 text-gray-500">
            Selamat datang, <strong>{{ session('username') }}</strong>.
            Berikut adalah ringkasan data sistem penyewaan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">



        <div
            class=" rounded-xl shadow hover:shadow-lg transition duration-300  bg-orange-50 border-l-4 border-orange-500 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Penyewaan
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $totalPenyewaan }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-orange-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 4.5h16.5v15H3.75V4.5Zm4.5 3h7.5M8.25 12h7.5M8.25 16.5h4.5" />
                    </svg>
                </div>

            </div>
        </div>

        <div
            class=" rounded-xl shadow hover:shadow-lg transition duration-300  bg-lime-50 border-l-4 border-lime-300 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Menunggu Pembayaran
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $menungguPembayaran }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6l4 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

            </div>
        </div>

        <div
            class="rounded-xl shadow hover:shadow-lg transition duration-300 bg-yellow-50 border-l-4 border-yellow-500 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Menunggu Verifikasi
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $menungguVerifikasi }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

            </div>
        </div>
        <div
            class=" rounded-xl shadow hover:shadow-lg transition duration-300 bg-blue-50 border-l-4 border-blue-500 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Disetujui
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $disetujui }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

            </div>
        </div>

        <div class="rounded-xl shadow hover:shadow-lg transition duration-300 bg-red-50 border-l-4 border-red-500 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Ditolak
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $ditolak }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 9-6 6m0-6 6 6" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

            </div>
        </div>

        <div
            class=" rounded-xl shadow hover:shadow-lg transition duration-300 bg-green-50 border-l-4 border-green-500 p-6">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Selesai
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-gray-800">
                        {{ $selesai }}
                    </h2>
                </div>

                <div class="p-3 rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75 10.5 18l9-13.5" />
                    </svg>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Pendapatan
                    </p>

                    <h2 class="mt-2 text-4xl font-bold text-green-600">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Total pendapatan dari penyewaan yang telah selesai.
                    </p>
                </div>

                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="w-9 h-9 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75h19.5V5.25H2.25v13.5ZM6.75 12a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Zm9.75 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="mt-8 bg-white rounded-xl shadow overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Penyewaan Terbaru
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Kode
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Pelanggan
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Tanggal Acara
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Total
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse ($latestOrders as $order)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 text-left">
                                {{ $order->kode_penyewaan }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {{ $order->pelanggan->nama }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {{ \Carbon\Carbon::parse($order->tanggal_acara)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                @if ($order->status == 'Menunggu Pembayaran')

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                        Menunggu Pembayaran
                                    </span>

                                @elseif ($order->status == 'Menunggu Verifikasi')

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                        Menunggu Verifikasi
                                    </span>

                                @elseif ($order->status == 'Disetujui')

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                        Disetujui
                                    </span>

                                @elseif ($order->status == 'Ditolak')

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                        Ditolak
                                    </span>

                                @elseif ($order->status == 'Selesai')

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                        Selesai
                                    </span>

                                @else

                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                        {{ $order->status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                Belum ada data penyewaan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-admin-layout>