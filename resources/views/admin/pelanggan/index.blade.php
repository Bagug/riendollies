<x-admin-layout>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Pelanggan
            </h1>

            <p class="text-gray-500">
                Daftar seluruh pelanggan yang telah terdaftar.
            </p>
        </div>


        <form method="GET" class="mt-4 md:mt-0">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama, username atau email..."
                class="w-full md:w-80 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
        </form>
    </div>


    <div class="overflow-hidden bg-white rounded-xl shadow">

        <table class="min-w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Username</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pelanggans as $pelanggan)

                    <tr class="border-t">

                        <td class="px-6 py-4">
                            {{ $loop->iteration + ($pelanggans->currentPage() - 1) * $pelanggans->perPage() }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $pelanggan->nama }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $pelanggan->username }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $pelanggan->email }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST"
                                onsubmit="return confirm('Hapus data pelanggan ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-6 text-gray-500">

                            Data pelanggan tidak ditemukan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-5">
        {{ $pelanggans->links() }}
    </div>

</x-admin-layout>