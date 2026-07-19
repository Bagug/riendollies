<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-20 max-h-20 w-auto object-contain" src="/images/rdft.png" alt="logo">

            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-center text-gray-900 md:text-2xl dark:text-white">
                        Buat akun baru
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('pelanggan.register.store') }}" method="POST">

                        @csrf
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" id="username"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('username')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Username"
                        >
                            @error('username')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('password')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            ="">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                                @error('password')
                                    border-red-500
                                @else
                                    border-gray-300
                                @enderror
                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Lengkap</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('nama')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Nama Lengkap" >
                            @error('nama')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                                    class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('alamat')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Alamat" >
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                HP</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('no_hp')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Nomor HP" >
                            @error('no_hp')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg
                            @error('email')
                                border-red-500
                            @else
                                border-gray-300
                            @enderror
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Email" >
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" aria-describedby="terms" type="checkbox"  value="1" {{ old('terms') ? 'checked' : '' }}
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                    >
                            </div>
                            
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">
                                    Saya menyetujui
                                    <a href="#" class="font-medium text-primary-600 hover:underline">
                                        syarat dan ketentuan
                                    </a>
                                </label>
                                @error('terms')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Buat
                            Akun</button>
                        <p class="text-sm font-light text-center text-gray-500 dark:text-gray-400">
                            Sudah punya akun? <a href="/login"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                                Disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>