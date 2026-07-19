<x-admin-layout>

    <x-slot:title>
        Data Dekorasi
    </x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

        <div class="mx-auto max-w-screen-xl">

            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <div class="flex justify-between items-center p-4 border-b">

                    <h2 class="text-2xl font-bold whitespace-nowrap">
                        Data Dekorasi
                    </h2>

                    <div class="flex items-center justify-between p-6 border-b">



                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                            <a href="{{ route('admin.dekorasi.create') }}"
                                class="inline-flex items-center justify-center px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 whitespace-nowrap">

                                + Tambah Data

                            </a>

                            <form action="{{ route('admin.dekorasi.index') }}" method="GET" class="flex w-full sm:w-auto">

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari dekorasi..." class="w-full sm:w-72 rounded-lg border-gray-300">

                                <button type="submit"
                                    class="rounded-r-lg bg-gray-700 px-5 text-white hover:bg-gray-800">

                                    Cari

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                {{-- @if (session('success'))
                    <div class="p-4 bg-green-100 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-gray-100 uppercase">

                            <tr>

                                <th class="px-6 py-3 text-center">No</th>

                                <th class="px-6 py-3 text-center">Kode</th>

                                <th class="px-6 py-3 text-center">Gambar</th>

                                <th class="px-6 py-3 text-center">Nama Dekorasi</th>

                                <th class="px-6 py-3 text-center">Kategori</th>

                                <th class="px-6 py-3 text-center">Harga</th>

                                <th class="px-6 py-3 text-center">Status</th>

                                <th class="px-6 py-3 text-center">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($dekorasis as $dekorasi)
                                <tr class="border-b">

                                    <td class="px-6 py-4 text-center">
                                        {{ $dekorasis->firstItem() + $loop->index }}
                                    </td>

                                    <td class="text-center">
                                        {{ $dekorasi->kode_dekorasi }}
                                    </td>

                                    <td class="px-6 py-4 ">
                                        <div class="flex justify-center">
                                            @if ($dekorasi->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $dekorasi->images->first()->image) }}"
                                                    alt="{{ $dekorasi->nama_dekorasi }}" onclick="showImage(this.src)"
                                                    class="w-20 item-center h-20 rounded-lg object-cover border cursor-pointer transition duration-300 hover:scale-105 hover:shadow-lg">
                                            @else
                                                <span class="text-gray-400">
                                                    Tidak ada gambar
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $dekorasi->nama_dekorasi }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $dekorasi->kategori->nama_kategori }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        Rp {{ number_format($dekorasi->harga, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $dekorasi->status_ketersediaan }}
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <button id="dropdownDefaultButton{{ $dekorasi->id_dekorasi }}"
                                            data-dropdown-toggle="dropdown{{ $dekorasi->id_dekorasi }}"
                                            class="text-gray-500 hover:text-gray-700">

                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">

                                                <path
                                                    d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />

                                            </svg>

                                        </button>

                                        <div id="dropdown{{ $dekorasi->id_dekorasi }}"
                                            class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">

                                            <ul class="py-2 text-sm text-gray-700">

                                                <li>

                                                    <a href="{{ route('admin.dekorasi.edit', $dekorasi) }}"
                                                        class="flex items-center w-full px-4 py-2 hover:bg-gray-100">

                                                        <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                            viewBox="0 0 20 20">

                                                            <path
                                                                d="M17.414 2.586a2 2 0 010 2.828l-9.5 9.5L5 15l.086-2.914 9.5-9.5a2 2 0 012.828 0z" />

                                                        </svg>

                                                        Edit

                                                    </a>

                                                </li>

                                                <li>

                                                    <form action="{{ route('admin.dekorasi.destroy', $dekorasi) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus dekorasi ini?')"
                                                            class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-red-600">

                                                            <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                viewBox="0 0 20 20">

                                                                <path
                                                                    d="M6 2a1 1 0 00-1 1v1H3v2h1l1 10a2 2 0 002 2h6a2 2 0 002-2l1-10h1V4h-2V3a1 1 0 00-1-1H6z" />

                                                            </svg>

                                                            Hapus

                                                        </button>

                                                    </form>

                                                </li>

                                            </ul>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">
                                        Data dekorasi belum tersedia.
                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                    <div class="px-6 py-4">
                        {{ $dekorasis->links() }}
                    </div>

                </div>

            </div>

        </div>

    </section>

    <script>
        function showImage(src) {

            document.getElementById('previewImage').src = src;

            document.getElementById('imageModal').classList.remove('hidden');

        }

        function closeImage() {

            document.getElementById('imageModal').classList.add('hidden');

        }

        document.addEventListener('keydown', function(e) {

            if (e.key === 'Escape') {

                closeImage();

            }

        });
    </script>
    <div id="imageModal" onclick="closeImage()"
        class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-5">

        <div class="relative" onclick="event.stopPropagation()">

            <button type="button" onclick="closeImage()"
                class="absolute -top-12 right-0 text-white text-5xl hover:text-red-400">

                &times;

            </button>

            <img id="previewImage" src="" class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl">

        </div>

    </div>

</x-admin-layout>
