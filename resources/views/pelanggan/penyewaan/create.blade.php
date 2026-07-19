<x-layout :title="'Form Penyewaan'">

    <div class="max-w-4xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-8">
            Form Penyewaan
        </h1>

        <form action="{{ route('pelanggan.penyewaan.store') }}" method="POST">
            @csrf

            <input type="hidden" name="is_cart" value="{{ ($isCart ?? false) ? 1 : 0 }}">

            @if(!($isCart ?? false))
                <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">
                <input type="hidden" name="id_layanan" value="{{ $layanan->getKey() }}">
            @endif

            <div class="bg-white rounded-xl shadow-lg p-8 space-y-6">

                @if($isCart ?? false)

                    <div>

                        <label class="block font-medium mb-4">
                            Daftar Layanan
                        </label>

                        @foreach($cart as $item)

                            <div class="flex justify-between border rounded-lg p-4 mb-3">

                                <div>

                                    <h3 class="font-semibold">
                                        {{ $item['nama_layanan'] }}
                                    </h3>

                                    <p class="text-gray-500">
                                        {{ ucfirst($item['jenis_layanan']) }}
                                    </p>

                                </div>

                                <p class="font-bold text-pink-600">

                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}

                                </p>

                            </div>

                        @endforeach

                        <div class="border-t pt-4 flex justify-between">

                            <span class="font-semibold">

                                Total

                            </span>

                            <span class="font-bold text-xl text-pink-600">

                                Rp {{ number_format($total, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                @else

                    <div>
                        <label class="block font-medium mb-2">
                            Nama Layanan
                        </label>

                        <input type="text" value="{{ $namaLayanan }}" class="w-full rounded-lg border-gray-300 bg-gray-100"
                            readonly>
                    </div>

                    <div>
                        <label class="block font-medium mb-2">
                            Harga
                        </label>

                        <input type="text" value="Rp {{ number_format($harga, 0, ',', '.') }}"
                            class="w-full rounded-lg border-gray-300 bg-gray-100" readonly>
                    </div>

                @endif

                <div>
                    <label class="block font-medium mb-2">
                        Periode Penyewaan
                    </label>

                    <div class="relative">

                        <input id="periode" type="text" readonly placeholder="Pilih tanggal penyewaan"
                            autocomplete="off" class="w-full rounded-lg border-gray-300 pr-10 cursor-pointer select-none bg-white
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500">



                        <button type="button" id="calendarButton" class="absolute right-3 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 text-gray-400 transition duration-200 hover:text-blue-600 hover:scale-110">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25m10.5-2.25v2.25M3.75 8.25h16.5M4.5 5.25h15a.75.75 0 01.75.75v12a.75.75 0 01-.75.75h-15A.75.75 0 013.75 18V6a.75.75 0 01.75-.75z" />

                            </svg>
                        </button>
                    </div>

                    @error('tanggal_acara')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('tanggal_selesai')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-5 rounded-xl border border-gray-200 bg-gray-50 p-4">

                    <p class="font-semibold text-sm mb-2 flex items-center gap-2">
                        📅 Keterangan
                    </p>

                    <div class="flex flex-wrap gap-5">

                        <div class="flex items-center gap-2 rounded-md bg-white px-3 py-2 shadow-sm">
                            <span class="w-4 h-4 rounded-full bg-red-500"></span>
                            <span class="text-sm">Sudah Dibooking</span>
                        </div>

                        <div class="flex items-center gap-2 rounded-md bg-white px-3 py-2 shadow-sm">
                            <span class="w-4 h-4 rounded-full bg-blue-600"></span>
                            <span class="text-sm">Tanggal Dipilih</span>
                        </div>

                    </div>
                    <p class="mt-3 text-sm text-gray-500 leading-6">
                        Pilih rentang tanggal yang masih tersedia.
                        Tanggal berwarna merah menunjukkan jadwal yang telah dibooking dan tidak dapat dipilih.
                    </p>
                </div>


                <input type="hidden" name="tanggal_acara" id="tanggal_acara" value="{{ old('tanggal_acara') }}">

                <input type="hidden" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">

                <div class="flex justify-end gap-3 mt-8">

                    @if($isCart ?? false)

                        <a href="{{ route('pelanggan.cart') }}">
                            Kembali
                        </a>

                    @else

                        <a href="{{ $routeKembali }}">
                            Kembali
                        </a>

                    @endif

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                        Buat Penyewaan

                    </button>

                </div>

            </div>

        </form>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const bookedDates = @json($bookedDates);

                    const fp = flatpickr("#periode", {

                        locale: Indonesian,

                        mode: "range",

                        dateFormat: "Y-m-d",

                        minDate: "today",

                        position: "auto right",

                        disable: bookedDates,

                        onReady: function (selectedDates, dateStr, instance) {

                            tandaiTanggalBooking(instance);

                        },

                        onMonthChange: function (selectedDates, dateStr, instance) {

                            tandaiTanggalBooking(instance);

                        },

                        onYearChange: function (selectedDates, dateStr, instance) {

                            tandaiTanggalBooking(instance);

                        },


                        onClose: function (selectedDates) {

                            if (selectedDates.length == 2) {

                                document.getElementById('tanggal_acara').value =
                                    flatpickr.formatDate(selectedDates[0], "Y-m-d");

                                document.getElementById('tanggal_selesai').value =
                                    flatpickr.formatDate(selectedDates[1], "Y-m-d");



                            }

                        }

                    });

                    const btn = document.getElementById("calendarButton");

                    btn.addEventListener("click", function (e) {

                        e.preventDefault();
                        fp.open();

                    });



                    function tandaiTanggalBooking(instance) {

                        const days = instance.calendarContainer.querySelectorAll(".flatpickr-day");

                        days.forEach(day => {

                            day.classList.remove("booked-date");

                            if (!day.classList.contains("flatpickr-disabled")) return;

                            const date = day.dateObj;

                            if (!date) return;

                            const format = flatpickr.formatDate(date, "Y-m-d");

                            bookedDates.forEach(range => {

                                if (format >= range.from && format <= range.to) {

                                    day.classList.add("booked-date");

                                }

                            });

                        });

                    }


                });
            </script>
        @endpush

    </div>

</x-layout>