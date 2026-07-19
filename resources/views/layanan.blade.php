<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 ">
            <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
                <h1 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">Layanan Kami</h1>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Menyediakan berbagai layanan, seperti
                    barang atau jasa seputar pernikahan</p>
            </div>

            <div class="w-full px-4 mx-auto">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                    <!-- CARD 1 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/dekorasi.jpeg" alt="Dekorasi">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Dekorasi</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menyediakan berbagai macam dekorasi pernikahan berkualitas yang siap membuat acara
                            pernikahan anda lebih megah dan istimewa!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="{{ route('pelanggan.dekorasi.index') }}"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>


                        </div>

                    </div>

                    <!-- CARD 2 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/rias.png" alt="Makeup">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Makeup</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menawarkan berbagai macam jasa layanan rias pengantin dan makeup artist yang ditangani oleh
                            tenaga profesional!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                    <!-- CARD 3 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/baju pengantin.jpg" alt="Pakaian">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Pakaian</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menyediakan berbagai macam pakaian pernikahan berkualitas yang siap membuat pengantin
                            terlihat lebih memukau dan percaya diri!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                    <!-- CARD 4 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/paket.jpg" alt="Paket Pernikahan">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Paket Pernikahan</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menawarkan berbagai macam paket pernikahan yang praktis dan lengkap sesuai dengan kebutuhan
                            anda!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                </div>

            </div>

            <div class="w-full py-10 px-4 mx-auto">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                    <!-- CARD 1 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/wo.jpg" alt="Dekorasi">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Wedding Organizer</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menyediakan jasa wedding organizer yang profesional dan berkualitas!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                    <!-- CARD 2 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/sax.jpg" alt="Makeup">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Hiburan</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menawarkan berbagai macam jasa hiburan yang mampu membuat acara anda lebih meriah!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                    <!-- CARD 3 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/perawatan.jpg" alt="Pakaian">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Treatment</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menyediakan jasa perawatan sebelum pernikahan!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                    <!-- CARD 4 -->
                    <div class="text-center bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col
                    transition-all duration-300 ease-in-out
                    hover:-translate-y-2 hover:scale-[1.02] hover:shadow-2xl hover:shadow-black/30">

                        <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/fg.jpg" alt="Paket Pernikahan">

                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">Photographer</a>
                        </h3>

                        <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                            Menawarkan jasa photographer yang profesional!
                        </p>

                        <div class="mt-auto flex justify-center">
                            <a href="#"
                                class="rounded-md bg-primary-700 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-800 transition">
                                Lihat
                            </a>
                        </div>

                    </div>

                </div>
                <div class="mt-10 flex justify-center">

                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">

                        Selengkapnya


                    </a>

                </div>
            </div>
        </div>
    </section>
</x-layout>