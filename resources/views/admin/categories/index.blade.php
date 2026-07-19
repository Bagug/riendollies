<x-admin-layout>

    <x-slot:title>
        Data Kategori
    </x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">

                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Data Kategori
                    </h2>

                    <a href="{{ route('admin.categories.create') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Tambah Kategori

                    </a>

                </div>

                {{-- Pesan Berhasil --}}
                {{-- @if (session('success'))
                    <div class="p-4 bg-green-100 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif --}}
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left text-gray-500">

                        <thead class="text-xs uppercase bg-gray-100 text-gray-700">

                            <tr>

                                <th class="px-6 py-3 text-center">
                                    No
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Kode
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Nama Kategori
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)
                                <tr class="border-b">

                                    <td class="px-6 py-4 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $category->kode_kategori }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        {{ $category->nama_kategori }}
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <button id="dropdownDefaultButton{{ $category->id_kategori }}"
                                            data-dropdown-toggle="dropdown{{ $category->id_kategori }}"
                                            class="text-gray-500 hover:text-gray-700">

                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">

                                                <path
                                                    d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" />

                                            </svg>

                                        </button>

                                        <div id="dropdown{{ $category->id_kategori }}"
                                            class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">

                                            <ul class="py-2 text-sm text-gray-700">

                                                <li>
                                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                                        class="flex items-center w-full px-4 py-2 hover:bg-gray-100">

                                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M17.414 2.586a2 2 0 010 2.828l-9.5 9.5L5 15l.086-2.914 9.5-9.5a2 2 0 012.828 0z" />
                                                        </svg>

                                                        Edit

                                                    </a>
                                                </li>

                                                <li>

                                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')"
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

                                    <td colspan="4" class="text-center py-5">

                                        Data kategori belum tersedia.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</x-admin-layout>