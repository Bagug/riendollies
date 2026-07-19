<x-admin-layout>

    <x-slot:title>
        Edit Data Kategori
    </x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

        <div class="mx-auto max-w-2xl">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">

                <div class="flex items-center justify-between p-6 border-b">

                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Data Kategori
                    </h2>

                </div>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="p-6">

                        <div>

                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Nama Kategori

                            </label>

                            <input
                                type="text"
                                name="nama_kategori"
                                value="{{ old('nama_kategori', $category->nama_kategori) }}"
                                class="w-full rounded-lg border border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan nama kategori"
                                required>

                            @error('nama_kategori')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 p-6 border-t">

                        <a href="{{ route('admin.categories.index') }}"
                            class="px-5 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</x-admin-layout>