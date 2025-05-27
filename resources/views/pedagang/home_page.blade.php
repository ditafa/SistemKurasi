<!-- resources/views/layouts/pedagang.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Dashboard Pedagang')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f5f2] text-[#555] min-h-screen flex flex-col">

  <!-- Header -->
  <header class="relative bg-[#739bb7] text-white px-8 py-4 shadow-md flex items-center h-28">
    <div class="z-10">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul" class="h-12">
    </div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
      <h1 class="text-2xl font-extrabold">Dashboard Pedagang</h1>
      <p class="text-sm max-w-xl">
        Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
      </p>
    </div>
  </header>

  <div class="flex flex-1">
    <!-- Sidebar -->
<aside class="bg-[#a9c1d3] w-64 p-6 flex flex-col space-y-6 text-[#555] font-semibold">
  <a href="{{ route('pedagang.profile') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- User Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.486 0 4.779.805 6.879 2.154M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <span>Profile</span>
  </a>

  <a href="{{ route('pedagang.products.index') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Box Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4M3 12l9 4 9-4" />
    </svg>
    <span>Produk Saya</span>
  </a>

  <a href="{{ route('pedagang.notifikasi') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Bell Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    <span>Notifikasi</span>
  </a>

  <a href="{{ route('pedagang.statistik') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Chart Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V3h2v8h-2zm-4 4v-4h2v4H7zm8 0v-6h2v6h-2zm4 4v-2H5v2h14z" />
    </svg>
    <span>Statistik</span>
  </a>

  <form action="{{ route('pedagang.logout') }}" method="POST" class="flex items-center space-x-3">
    @csrf
    <button type="submit" class="flex items-center space-x-3 hover:text-red-600">
      <!-- Logout Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h7a1 1 0 011 1v1" />
      </svg>
      <span>Logout</span>
    </button>
  </form>
</aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      <div class="bg-white rounded-lg shadow-md p-6 mb-6 text-center border border-[#5f86a0]">
        <h2 class="text-xl font-bold text-[#5f86a0]">Selamat Datang, Pedagang!</h2>
        <p class="text-sm text-[#777] mt-2">Kelola produk, pantau notifikasi, dan lihat statistik perkembangan bisnismu.</p>
      </div>
      
      @yield('content')
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-[#739bb7] text-white py-4 text-center text-sm">
    &copy; 2025 Pemerintah Kabupaten Bantul. All rights reserved.
  </footer>

</body>
</html>
