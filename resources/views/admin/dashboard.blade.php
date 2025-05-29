<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
  <body class="h-full bg-[#F8FFF9] text-gray-700 font-sans flex">

    <!-- Sidebar (selalu tampil di desktop) -->
    <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6">
      <!-- Logo & Navigation -->
      <div>
        <div class="flex items-center justify-between mb-10">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-16"
          />
        </div>

        <!-- Navigation -->
            <nav class="flex flex-col space-y-4 text-sm font-medium">
            <a href="/" class="hover:text-green-200">Beranda</a>
            <a href="/about" class="hover:text-green-200">Tentang Kami</a>
            <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
            <a href="{{ route('admin.dataproduk.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Data Produk</a>
            <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
            </form>
          </div>  

        </nav>
      </div>

      <!-- Footer -->
      <footer class="text-center text-xs font-semibold text-white/70">
        © 2025 PemKab Bantul. All Rights Reserved.
      </footer>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:ml-64 flex flex-col items-center justify-center min-h-screen">
      <header class="max-w-4xl mb-12 text-center">
        <h1 class="text-4xl font-extrabold text-[#4a8a4a] leading-tight mb-2">DASHBOARD ADMIN</h1>
        <p class="text-sm text-gray-600 max-w-lg mx-auto">
          Pedagang dapat mengajukan produk serta mencatat riwayat perubahan status secara transparan.
        </p>
      </header>

      <section class="max-w-4xl border border-[#4a8a4a] rounded-xl p-6 bg-[#e6f0db] shadow-sm w-full">
        <h2 class="font-bold text-lg text-[#5a5a5a] mb-6 text-center">Dashboard</h2>

        <article
          class="bg-[#f0f7e9] border border-[#a3c0d1] rounded-xl p-10 shadow-md text-center text-[#5a5a5a] text-base space-y-10 mx-auto max-w-xl"
        >
          <p class="text-lg font-normal">Selamat Datang, Admin!</p>
          <p class="mx-auto max-w-md">
            Anda dapat memantau, meninjau, dan mengelola seluruh produk yang diajukan oleh para pedagang melalui sistem kurasi ini.
          </p>
          <p class="text-lg font-normal">Pilih Menu Sidebar</p>
        </article>
      </section>
    </main>
  </body>
</html>
