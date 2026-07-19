<x-admin-layout>

    <x-slot name="title">
        Data Penyewaan
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-semibold mb-4">
            Data Penyewaan
        </h2>

        <table class="min-w-full border border-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="border p-3">Kode</th>
                    <th class="border p-3">Pelanggan</th>
                    <th class="border p-3">Tanggal Acara</th>
                    <th class="border p-3">Total</th>
                    <th class="border p-3">Status</th>
                    <th class="border p-3">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($penyewaans as $penyewaan)

                    <tr>

                        <td class="border p-3 text-center">
                            {{ $penyewaan->kode_penyewaan }}
                        </td>

                        <td class="border p-3 text-center">
                            {{ $penyewaan->pelanggan->nama }}
                        </td>

                        <td class="border p-3 text-center">
                            {{ \Carbon\Carbon::parse($penyewaan->tanggal_acara)->format('d-m-Y') }}
                        </td>

                        <td class="border p-3 text-center">
                            Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                        </td>

                        <td class="border p-3 text-center">
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

                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $penyewaan->status }}
                        </span>
                        </td>


                        <td class="border p-3 text-center">

                            <a href="{{ route('admin.penyewaan.show', $penyewaan->id_penyewaan) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center p-5">

                            Belum ada data penyewaan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-4">

            {{ $penyewaans->links() }}

        </div>

    </div>

</x-admin-layout>