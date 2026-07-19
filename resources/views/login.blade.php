<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="h-20 max-h-20 w-auto object-contain" src="/images/rdft.png" alt="logo">
            </a>

            <div
                class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border dark:border-gray-700">

                <div class="p-6 space-y-4 sm:p-8">

                    <h1
                        class="text-xl font-bold text-center  leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login ke akun anda
                    </h1>

                    @if(session('success'))
                        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-300">
                            <svg class="w-5 h-5 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M18 10A8 8 0 1110 2a8 8 0 018 8zM9 7h2v5H9V7zm0 6h2v2H9v-2z" />
                            </svg>

                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pelanggan.login.process') }}" class="space-y-4">

                        @csrf

                        {{-- Username --}}
                        <div>

                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Username

                            </label>

                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                placeholder="Masukkan username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                @error('username') border-red-500 @enderror">

                            @error('username')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Password --}}
                        <div>

                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">

                                Password

                            </label>

                            <input type="password" name="password" id="password" placeholder="Masukkan password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                @error('password') border-red-500 @enderror">

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="flex justify-end">

                            <a href="#" class="text-sm font-medium text-blue-600 hover:underline">

                                Lupa Password?

                            </a>

                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">

                            Login

                        </button>

                        <p class="text-sm text-center text-gray-500">

                            Belum punya akun?

                            <a href="/register" class="font-medium text-blue-600 hover:underline">

                                Daftar

                            </a>

                        </p>

                    </form>

                </div>

            </div>

        </div>
    </section>

</x-layout>