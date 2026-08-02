<x-admin-layout>

    <x-slot:title>
        Edit Data Paket Pernikahan
    </x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">

        <div class="mx-auto max-w-4xl">

            <div class="bg-white shadow-md rounded-lg">

                <div class="p-6 border-b">

                    <h2 class="text-xl font-semibold">
                        Edit Data Paket Pernikahan
                    </h2>

                </div>

                <form action="{{ route('admin.paket-pernikahan.update', $paketPernikahan) }}" method="POST"
                    enctype="multipart/form-data" class="p-6 space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Kategori --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">

                            Kategori

                        </label>

                        <select name="id_kategori" class="w-full rounded-lg border px-3 py-2 @error('id_kategori') border-red-500 @else border-gray-300 @enderror">

                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id_kategori }}"
                                    {{ old('id_kategori', $paketPernikahan->id_kategori) == $category->id_kategori ? 'selected' : '' }}>

                                    {{ $category->nama_kategori }}

                                </option>
                            @endforeach

                            @error('id_kategori')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                        </select>

                    </div>

                    {{-- Nama --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">

                            Nama Paket Pernikahan

                        </label>

                        <input type="text" name="nama_paket" value="{{ old('nama_paket', $paketPernikahan->nama_paket) }}"
                            class="w-full rounded-lg border-gray-300
                            @error('nama_paket')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror">

                        @error('nama_paket')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Harga --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">

                            Harga

                        </label>

                        <input type="number" name="harga" value="{{ old('harga', $paketPernikahan->harga) }}"
                            class="w-full rounded-lg border px-3 py-2
                            @error('harga')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror">

                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">

                            Status

                        </label>

                        <select name="status_ketersediaan" class="w-full rounded-lg border-gray-300">

                            <option value="Tersedia"
                                {{ old('status_ketersediaan', $paketPernikahan->status_ketersediaan) == 'Tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="Tidak Tersedia"
                                {{ old('status_ketersediaan', $paketPernikahan->status_ketersediaan) == 'Tidak Tersedia' ? 'selected' : '' }}>
                                Tidak Tersedia
                            </option>

                        </select>

                    </div>

                    {{-- Deskripsi --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">

                            Deskripsi

                        </label>

                        <textarea rows="5" name="deskripsi"
                            class="w-full rounded-lg border-gray-300 @error('deskripsi') border-red-500 @else border-gray-300 @enderror">{{ old('deskripsi', $paketPernikahan->deskripsi) }}</textarea>


                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Gambar --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium">
                            Foto Paket Pernikahan
                        </label>

                        {{-- Tombol Upload --}}
                        <div class="flex items-center gap-3 mb-4">

                            <label for="images"
                                class="cursor-pointer rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">

                                Pilih Foto

                            </label>

                            <span id="file-name" class="text-sm text-gray-500">
                                Belum ada file dipilih
                            </span>

                            <input type="file" id="images" name="images[]" multiple accept="image/*"
                                class="hidden">

                        </div>

                        {{-- Foto Lama --}}
                        <div class="flex flex-wrap gap-3 mb-4">

                            @foreach ($paketPernikahan->images as $image)
                                <div class="relative w-28 h-28" id="image-{{ $image->id }}">

                                    <img src="{{ asset('storage/' . $image->image) }}" onclick="showImage(this.src)"
                                        class="w-28 h-28 rounded-lg border object-cover cursor-pointer transition duration-300 hover:scale-105 hover:shadow-xl">

                                    <button type="button" onclick="hapusFoto({{ $image->id }})"
                                        class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-red-600 text-white text-sm hover:bg-red-700 shadow">

                                        ×

                                    </button>

                                </div>
                            @endforeach

                        </div>

                        <p class="text-sm text-gray-500">
                            Kamu bisa memilih lebih dari satu foto.
                        </p>

                        <div id="preview" class="grid grid-cols-4 gap-4 mt-4"></div>

                        
                        @error('images')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @foreach ($errors->get('images.*') as $messages)
                            @foreach ($messages as $message)
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @endforeach
                        @endforeach
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3">

                        <a href="{{ route('admin.paket-pernikahan.index') }}"
                            class="px-5 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">

                            Kembali

                        </a>

                        <button type="submit" class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>




    <script>
        const input = document.getElementById('images');
        const preview = document.getElementById('preview');
        const fileName = document.getElementById('file-name');

        // =========================
        // PREVIEW UPLOAD
        // =========================

        let selectedFiles = [];

        input.addEventListener('change', function(e) {

            selectedFiles = Array.from(e.target.files);

            renderPreview();

        });

        function renderPreview() {

            preview.innerHTML = "";

            if (selectedFiles.length > 0) {

                fileName.textContent = `${selectedFiles.length} file dipilih`;

            } else {

                fileName.textContent = "Belum ada file dipilih";

            }

            selectedFiles.forEach((file, index) => {

                const reader = new FileReader();

                reader.onload = function(event) {

                    preview.innerHTML += `

            <div class="relative w-32 h-32">

                <img
                    src="${event.target.result}"
                    onclick="showImage('${event.target.result}')"
                    class="w-32 h-32 rounded-lg object-cover border shadow cursor-pointer transition duration-300 hover:scale-105 hover:shadow-xl">

                <button
                    type="button"
                    onclick="removeImage(${index})"
                    class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-red-600 text-white hover:bg-red-700 shadow">

                    ×

                </button>

            </div>

            `;

                }

                reader.readAsDataURL(file);

            });

        }

        function removeImage(index) {

            selectedFiles.splice(index, 1);

            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {

                dataTransfer.items.add(file);

            });

            input.files = dataTransfer.files;

            renderPreview();

        }


        // =========================
        // LIGHTBOX
        // =========================

        function showImage(src) {

            const imageModal = document.getElementById('imageModal');
            const previewImage = document.getElementById('previewImage');

            previewImage.src = src;

            imageModal.classList.remove('hidden');

        }

        function closeImage() {

            document.getElementById('imageModal').classList.add('hidden');

        }

        function hapusFoto(id) {
            if (!confirm('Hapus foto ini?')) return;

            fetch(`/admin/paket-pernikahan/image/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {

                    if (response.ok) {

                        document.getElementById(`image-${id}`).remove();

                    } else {

                        alert('Gagal menghapus foto.');

                    }

                })
                .catch(() => {

                    alert('Terjadi kesalahan.');

                });

        }

        // Tutup dengan tombol ESC
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
                class="absolute -top-12 right-0 text-white text-5xl hover:text-red-400 transition">

                &times;

            </button>

            <img id="previewImage" src="" alt="Preview"
                class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl">

        </div>

    </div>
</x-admin-layout>
