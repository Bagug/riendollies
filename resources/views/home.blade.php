<x-layout>
  <x-slot:title> {{ $title }} </x-slot:title>
  
<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<div class="relative bg-cover bg-center min-h-screen"
     style="background-image: url('/images/bg.jpg');"> 
     
      <div class="absolute inset-0 bg-black/50"></div>
  
  <div class="relative px-6 pt-14 lg:px-8">
    <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
      <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>
    <div class="mx-auto max-w-2xl py-10 sm:py-14 lg:py-16">
      <div class="hidden sm:mb-8 sm:flex sm:justify-center">
       
      </div>
      <div class="text-center">
        <h1 class="text-balance text-5xl font-semibold font-poppinstracking-tight text-white sm:text-6xl">Wujudkanlah pernikahan impianmu bersama Riendollies</h1>
        <p class="mt-8 text-pretty text-lg font-medium font-poppins text-gray-300 sm:text-xl/8">Penyewaan alat pernikahan lengkap, berkualitas dan siap mendukung momen sakral anda</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="#" class="rounded-md bg-primary-700 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Booking</a>
        </div>
      </div>
    </div>
    <div aria-hidden="true" class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
      <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
    </div>
  </div>
</div>


<!-- TENTANG KAMI -->
  <section class="bg-white dark:bg-gray-900">
    
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-5xl dark:text-white">Tentang Kami</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 text-justify lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Riendollies merupakan penyedia jasa penyewaan alat pernikahan yang menyediakan berbagai perlengkapan berkualitas untuk mendukung kelancaran dan keindahan acara pernikahan, dengan layanan yang professional, mudah dan terpercaya. Riendollies hadir sebagai mitra bagi pasangan dalam mewujudkan momen pernikahan yang berkesan dan tak terlupakan.</p>
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                Selengkapnya
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
           
        </div>
                    
        <div 
          x-data="{
              activeSlide: 0,
              slides: [
                  '/images/dekorasi.jpeg',
                  '/images/dekor 2.jpeg',
                  '/images/dekor 3.webp',
                  '/images/baju jawa.jpg',
                  '/images/baju sunda.jpg'
              ],

              init() {
                  setInterval(() => {
                      this.next()
                  }, 5000)
              },

              next() {
                  this.activeSlide = (this.activeSlide + 1) % this.slides.length
              },

              prev() {
                  this.activeSlide =
                      this.activeSlide === 0
                      ? this.slides.length - 1
                      : this.activeSlide - 1
              }
          }"

          class="hidden relative lg:mt-0 lg:col-span-5 lg:flex items-center justify-center"
      >

    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <img 
            x-show="activeSlide === index"
            :src="slide"
            x-transition:enter="transition-opacity duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="rounded-2xl w-[350px] h-[350px] object-cover shadow-xl absolute"
        >
    </template>

    <!-- Left Button -->
    <button 
        @click="prev()"
        class="absolute left-0 bg-white/80 hover:bg-white text-black rounded-full w-10 h-10 shadow-md"
    >
        ❮
    </button>

    <!-- Right Button -->
    <button 
        @click="next()"
        class="absolute right-0 bg-white/80 hover:bg-white text-black rounded-full w-10 h-10 shadow-md"
    >
        ❯
    </button>
        </div>
    </div>
     <hr class="border-gray-300 my-8">
</section>


<!-- LAYANAN KAMI -->
<section class="bg-gray-100 dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 ">
      <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
          <h1 class="mb-4 text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">Layanan Kami</h1>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Menyediakan berbagai layanan, seperti barang atau jasa seputar pernikahan</p>
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
                Menyediakan berbagai macam dekorasi pernikahan berkualitas yang siap membuat acara pernikahan anda lebih megah dan istimewa!
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

            <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="/images/rias.png" alt="Makeup">

            <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <a href="#">Makeup</a>
            </h3>

            <p class="text-xs mb-4 leading-snug text-gray-500 dark:text-gray-400">
                Menawarkan berbagai macam jasa layanan rias pengantin dan makeup artist yang ditangani oleh tenaga profesional!
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
                Menyediakan berbagai macam pakaian pernikahan berkualitas yang siap membuat pengantin terlihat lebih memukau dan percaya diri!
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
                Menawarkan berbagai macam paket pernikahan yang praktis dan lengkap sesuai dengan kebutuhan anda!
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

              <a href="/layanan"
                 class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">

                  Selengkapnya

                  
              </a>

          </div>
  </div>
   
</div>  
<hr class=" border-gray-300">

<!-- HUBUNGI KAMI -->

<section class="bg-white dark:bg-gray-900">

  <h1 class="mb-4 py-10 text-5xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
      Hubungi Kami
  </h1>

  <div class="gap-4 items-center py-8 px-2 mx-auto max-w-screen-lg md:grid md:grid-cols-2 sm:py-12 lg:px-4">

      <!-- MAP -->
      <div class="w-full max-w-md mx-auto md:mx-0 aspect-square rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700">

          <iframe
              class="w-full h-full"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.3678841273495!2d107.9392415793457!3d-6.846426399999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68d144d6cc5e9b%3A0xa9c08a143bc3f04e!2sRien%20Dollies!5e0!3m2!1sid!2sid!4v1778182047081!5m2!1sid!2sid"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
          </iframe>

      </div>

      <!-- TEXT  -->
     <div class="mt-6 md:mt-0 md:-ml-4  flex flex-col gap-4 self-start">

    <!-- INSTAGRAM -->
    <a href="https://instagram.com/rien_dollies"
       class="inline-flex items-center gap-2 text-xl text-semibold text-gray-800 dark:text-white hover:text-pink-500 transition">

        <svg class="w-[35px] h-[35px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
</svg>


        <span>rien_dollies</span>
    </a>

    <!-- WHATSAPP -->
    <a href="https://wa.me/6281234567890"
       class="inline-flex items-center gap-2 text-xl text-semibold text-gray-800 dark:text-white hover:text-green-500 transition">

        <svg class="w-[35px] h-[35px] text-gray-800 dark:text-white" aria-hidden="true"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
  <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
</svg>


        <span>+62 812-3456-7890</span>
    </a>

    <!-- EMAIL -->
    <a href="mailto:info@riendollies.com"
       class="inline-flex items-center gap-2 text-xl text-semibold text-gray-800 dark:text-white hover:text-blue-500 transition">

       <svg class="w-[35px] h-[35px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
</svg>


        <span>info@riendollies.com</span>
    </a>

    <!-- ALAMAT -->
    <div class="inline-flex items-center gap-2 text-xl text-semibold text-gray-800 dark:text-white">

        <svg class="w-[35px] h-[35px]  flex-shrink-0 text-gray-800 dark:text-white" aria-hidden="true" style="display:block;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
</svg>


        <span>Jl. Terusan Rancapurut, Rancamulya, Kec. Sumedang Utara, Kabupaten Sumedang, Jawa Barat 45621</span>
    </div>

</div> 
      

      </div>

  </div>
<hr class=" border-gray-300">
</section>
</section>
     
  </div>
</section>
</x-layout>