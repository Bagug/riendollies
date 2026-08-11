@php
    $cartCount = count(session('cart', []));
@endphp

<nav class="relative z-50 bg-gray-100" x-data="{
        mobileOpen: false,
        profileOpen: false
    }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="/images/logord.png" alt="Your Company" class="size-12" />
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                        <x-nav-link href="/about" :active="request()->is('about')">Tentang Kami</x-nav-link>
                        <x-nav-link href="/layanan" :active="request()->is('layanan')">Layanan Kami</x-nav-link>
                        @if(session('login_pelanggan'))
                            <x-nav-link href="/pesanan" :active="request()->is('pesanan')">
                                Pesanan Saya
                            </x-nav-link>
                        @endif

                    </div>
                </div>
            </div>


            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <a href="{{ route('pelanggan.cart') }}"
                        class="relative p-2 rounded-full hover:bg-blue-50  hover:text-blue-600 transition mr-8">

                        <!-- keranjang -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="w-7 h-7">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386a.75.75 0 01.728.568l.894 3.577m0 0L6.75 15h10.878a.75.75 0 00.728-.568l1.35-5.4a.75.75 0 00-.728-.932H5.258zM6.75 18.75a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm10.5 0a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                        </svg>

                        @if($cartCount > 0)
                            <span class="
                                    absolute
                                    -top-1
                                    -right-1
                                    bg-red-500
                                    text-white
                                    text-[9px]
                                    font-bold
                                    rounded-full
                                    min-w-4
                                    h-4
                                    flex
                                    items-center
                                    justify-center
                                    px-1
                                    ">

                                {{ $cartCount }}

                            </span>
                        @endif

                    </a>

                    <div class="relative ml-3">

                        <button type="button" @click="profileOpen = !profileOpen"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white hover:bg-gray-50">

                            @if(session('login_pelanggan'))

                                <span
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-rose-500 text-white font-bold text-lg">
                                    {{ strtoupper(substr(session('nama'), 0, 1)) }}
                                </span>

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                    stroke="currentColor" class="w-12 h-12">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0a9 9 0 10-11.964 0m11.964 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0Z" />

                                </svg>

                            @endif

                        </button>
                        <!-- dropdown -->
                        <div x-cloak x-show="profileOpen" @click.outside="profileOpen = false"
                            @keydown.escape.window="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 rounded-lg bg-white shadow-lg border">

                            @if(session('login_pelanggan'))

                                <div class="border-b px-4 py-3">

                                    <p class="font-semibold">
                                        {{ session('nama') }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ session('username') }}
                                    </p>

                                </div>

                                <a href="{{ route('pelanggan.profil.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Profil Saya
                                </a>

                                <a href="{{ route('pelanggan.pesanan') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Pesanan Saya
                                </a>

                                <form action="{{ route('pelanggan.logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="block w-full px-4 py-2 text-left hover:bg-gray-100">
                                        Logout

                                    </button>

                                </form>

                            @else

                                <a href="{{ route('pelanggan.login') }}" class="block px-4 py-2 hover:bg-gray-100">

                                    Login

                                </a>

                                <a href="{{ route('pelanggan.register') }}" class="block px-4 py-2 hover:bg-gray-100">

                                    Register

                                </a>

                            @endif

                        </div>

                    </div>

                </div>
            </div>

            <div class="-mr-2 flex items-center gap-2 md:hidden">

                {{-- Keranjang Mobile --}}
                <a href="{{ route('pelanggan.cart') }}"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-white hover:bg-gray-700">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-6 w-6">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386a.75.75 0 01.728.568l.894 3.577m0 0L6.75 15h10.878a.75.75 0 00.728-.568l1.35-5.4a.75.75 0 00-.728-.932H5.258zM6.75 18.75a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm10.5 0a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>

                    @if($cartCount > 0)
                        <span
                            class="absolute -right-1 -top-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-red-500 px-1 text-[9px] font-bold text-white">
                            {{ $cartCount }}
                        </span>
                    @endif

                </a>


                {{-- Hamburger --}}
                <button type="button" @click="mobileOpen = !mobileOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none"
                    aria-controls="mobile-menu">

                    <span class="sr-only">Open main menu</span>

                    <svg :class="{ 'block': !mobileOpen, 'hidden': mobileOpen }" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <svg :class="{ 'hidden': !mobileOpen, 'block': mobileOpen }" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen" x-transition class="border-t border-gray-200 bg-gray-100 md:hidden" id="mobile-menu">

        {{-- Menu utama --}}

       <div class="space-y-1 px-4 pb-3 pt-3">

    {{-- Beranda --}}
    <a href="/"
       class="block w-full rounded-md px-3 py-2 text-base font-medium
       {{ request()->is('/')
            ? 'bg-gray-900 text-white'
            : 'text-gray-700 hover:bg-white' }}">
        Beranda
    </a>

    {{-- Tentang Kami --}}
    <a href="/about"
       class="block w-full rounded-md px-3 py-2 text-base font-medium
       {{ request()->is('about')
            ? 'bg-gray-900 text-white'
            : 'text-gray-700 hover:bg-white' }}">
        Tentang Kami
    </a>

    {{-- Layanan Kami --}}
    <a href="/layanan"
       class="block w-full rounded-md px-3 py-2 text-base font-medium
       {{ request()->is('layanan')
            ? 'bg-gray-900 text-white'
            : 'text-gray-700 hover:bg-white' }}">
        Layanan Kami
    </a>

    {{-- Pesanan Saya --}}
    @if(session('login_pelanggan'))
        <a href="/pesanan"
           class="block w-full rounded-md px-3 py-2 text-base font-medium
           {{ request()->is('pesanan*')
                ? 'bg-gray-900 text-white'
                : 'text-gray-700 hover:bg-white' }}">
            Pesanan Saya
        </a>
    @endif

</div>


        {{-- Profile mobile --}}
        <div class="border-t border-gray-300 px-4 pb-4 pt-4">

            @if(session('login_pelanggan'))

                <div class="mb-3">
                    <p class="font-semibold text-gray-900">
                        {{ session('nama') }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ session('username') }}
                    </p>
                </div>

                <a href="{{ route('pelanggan.profil.edit') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-white">
                    Profil Saya
                </a>

                <a href="{{ route('pelanggan.cart') }}"
                    class="flex items-center justify-between rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-white">

                    <span>Keranjang</span>

                    @if($cartCount > 0)
                        <span
                            class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-xs font-bold text-white">
                            {{ $cartCount }}
                        </span>
                    @endif

                </a>

                <form action="{{ route('pelanggan.logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="block w-full rounded-md px-3 py-2 text-left text-base font-medium text-gray-700 hover:bg-white">
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('pelanggan.login') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-white">
                    Login
                </a>

                <a href="{{ route('pelanggan.register') }}"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-white">
                    Register
                </a>

            @endif

        </div>

    </div>
</nav>