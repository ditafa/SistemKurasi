<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Produk Pedagang- Kurasi Bantul</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="h-full bg-[#F8FFF9] text-gray-700 font-sans flex">

    <!-- Sidebar -->
    <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6">
      <div>
        <!-- Logo -->
        <div class="flex items-center justify-between mb-10">
          <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-16" />
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
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
            </form>
          </div>
        </nav>
      </div>

      <!-- Footer -->
      <div class="px-6 py-3 text-xs font-bold flex items-center gap-2 border-t border-white/20">
        <i class="fas fa-eye"></i>
        <span>2025 PemKab Bantul. All Rights Reserved.</span>
      </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-10 ml-0 md:ml-64">
      <section class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-extrabold text-[#5a8a4f] mb-1">DATA PRODUK</h1>
        <p class="text-xs text-[#6b6b6b] mb-8 max-w-xl leading-tight">
          Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
        </p>

        <!-- Produk Box -->
        <section class="bg-[#e6f0d9] border border-[#5a8a4f] rounded-xl p-8 max-w-5xl shadow-inner">
          <h2 class="text-lg font-bold text-[#5a5a5a] mb-6">Daftar Produk</h2>
          
          <!-- Search and Filters -->
          <div class="bg-[#f0f7f3] border border-[#a9c6d1] rounded-xl p-6 shadow-md overflow-x-auto">
            <form class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6" role="search">
              <label for="search" class="sr-only">Cari produk</label>
              <div class="flex items-center border border-[#a9c6d1] rounded-md px-3 py-2 w-full sm:w-72 text-[#5a8a4f]">
                <i class="fas fa-search mr-2"></i>
                <input
                  type="search"
                  id="search"
                  name="search"
                  placeholder="Cari produk..."
                  class="w-full bg-transparent text-xs placeholder-[#a9c6d1] focus:outline-none"
                />
              </div>

              <select name="status" id="status" class="border border-[#a9c6d1] rounded-md px-3 py-2 text-xs text-[#5a8a4f] w-28">
                <option>Status</option>
                <option>Aktif</option>
                <option>Tidak Aktif</option>
              </select>

              <select name="kategori" id="kategori" class="border border-[#a9c6d1] rounded-md px-3 py-2 text-xs text-[#5a8a4f] w-28">
                <option>Kategori</option>
                <option>Makanan</option>
                <option>Minuman</option>
                <option>Kerajinan</option>
              </select>
            </form>

            <!-- Tabel Produk -->
            <table class="w-full text-xs text-[#5a8a4f] border-separate border-spacing-y-4">
              <thead>
                <tr class="font-bold text-[#8cae8a]">
                  <th class="text-left pl-3">Produk</th>
                  <th class="text-left">Kategori</th>
                  <th class="text-left">Harga</th>
                  <th class="text-left">Status</th>
                  <th class="text-left pr-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
              </tbody>
            </table>

            <a href="{{ route('pedagang.produk.create') }}" class="absolute top-8 right-8 bg-[#0f6b3f] text-white text-sm font-semibold rounded-full px-5 py-2">
            Tambah Produk
          </a>


            <!-- Pagination -->
            <nav class="mt-6 flex items-center gap-1 text-xs text-[#5a8a4f] select-none" aria-label="Pagination">
              <button class="border border-[#a9c6d1] rounded px-2 py-1 disabled:text-[#a9c6d1] disabled:border-[#e6f0d9]" disabled>&lt;</button>
              <button class="bg-[#5a8a4f] text-white rounded px-2 py-1 font-bold" aria-current="page">1</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">2</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">3</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">4</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">5</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">6</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">7</button>
              <button class="border border-[#5a8a4f] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">8</button>
              <button class="border border-[#a9c6d1] rounded px-2 py-1 hover:bg-[#5a8a4f] hover:text-white">&gt;</button>
            </nav>
          </div>
        </section>
      </section>
    </main>
  </body>
</html>
