<!DOCTYPE html>
<html lang="en"  class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full">

<div class="min-h-full">
 <x-navbar></x-navbar>
 
 {{-- <x-header>{{ $title }}</x-header> --}}
  
  <main>
    <div class="w-full">
        {{ $slot }}
      <!-- Your content -->
    </div>
  </main>
</div>

<x-footer></x-footer>
@stack('scripts')

</body>
  

</html>



  