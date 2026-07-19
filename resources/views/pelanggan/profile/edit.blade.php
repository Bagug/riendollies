<x-layout>

    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6 text-center">
            Profil Saya
        </h1>

        <form action="{{ route('pelanggan.profil.update') }}" method="POST" class="bg-white rounded-xl shadow p-8 space-y-5">

            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block mb-2 font-medium">
                    Nama
                </label>

                <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama) }}"
                    class="w-full rounded-lg border-gray-300">

                @error('nama')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label class="block mb-2 font-medium">
                    Username
                </label>

                <input type="text" name="username" value="{{ old('username', $pelanggan->username) }}"
                    class="w-full rounded-lg border-gray-300">

                @error('username')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-2 font-medium">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email', $pelanggan->email) }}"
                    class="w-full rounded-lg border-gray-300">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- No HP --}}
            <div>
                <label class="block mb-2 font-medium">
                    Nomor HP
                </label>

                <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}"
                    class="w-full rounded-lg border-gray-300">

                @error('no_hp')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-2 font-medium">
                    Alamat
                </label>

                <textarea name="alamat" rows="3"
                    class="w-full rounded-lg border-gray-300">{{ old('alamat', $pelanggan->alamat) }}</textarea>

                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <hr>

            <h2 class="font-semibold text-lg">
                Ubah Password (Opsional)
            </h2>

            {{-- Password --}}
            <div>
                <label class="block mb-2 font-medium">
                    Password Baru
                </label>

                <input type="password" name="password" class="w-full rounded-lg border-gray-300">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Konfirmasi --}}
            <div>
                <label class="block mb-2 font-medium">
                    Konfirmasi Password
                </label>

                <input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300">
            </div>

            <div class="flex justify-end gap-3 mt-6">

    <a href="{{ route('home') }}"
        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-100">
        Batal
    </a>

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
        Simpan Perubahan
    </button>

</div>

        </form>

    </div>

</x-layout>