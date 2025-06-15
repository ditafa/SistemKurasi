<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
  </head>
  <body class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col">

    <div class="flex flex-1">

      <!-- Sidebar Desktop -->
      <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10">
        <div>
          <div class="flex items-center justify-between mb-10">
            <img
              src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
              alt="Logo"
              class="h-12"/>
          </div>
          <nav class="flex flex-col space-y-4 text-sm font-medium">
            <a href="/" class="hover:text-green-200">Beranda</a>
            <a href="/about" class="hover:text-green-200">Tentang Kami</a>
            <a href="/kontak" class="hover:text-green-200">Kontak</a>
            <hr class="border-white/40 my-6" />
            <div class="space-y-3">
              <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
              <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
              <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
              <a href="{{ route('admin.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Notifikasi</a>
              <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
              <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
              </form>
            </div>
          </nav>
        </div>
      </aside>

      <!-- Sidebar Mobile -->
      <div class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity></div>
      <div
        class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
        <div class="flex justify-between items-center mb-6">
          <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-10">
          <button class="text-white text-2xl" @click="sidebarOpen = false">×</button>
        </div>
        <nav class="flex flex-col space-y-3 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/20 my-4" />
          <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200">Dashboard</a>
          <a href="{{ route('admin.products.index') }}" class="hover:text-green-200">Daftar Produk</a>
          <a href="{{ route('admin.kategori.index') }}" class="hover:text-green-200">Kategori</a>
          <a href="{{ route('admin.notifikasi') }}" class="hover:text-green-200">Notifikasi</a>
          <a href="{{ route('admin.statistik') }}" class="hover:text-green-200">Statistik</a>
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-left hover:text-green-200">Logout</button>
          </form>
        </nav>
      </div>

      <!-- Konten Utama -->
      <div class="flex-1 flex flex-col min-h-screen md:ml-64">
        <!-- Header mobile -->
        <header class="md:hidden flex justify-between items-center px-4 py-3 bg-white shadow z-10">
          <button @click="sidebarOpen = true" class="text-2xl text-[#14532D]">☰</button>
          <span class="font-bold text-[#14532D]">Dashboard Admin</span>
        </header>

        <main class="p-6 flex-1 mb-20">
          <header class="max-w-4xl mb-12 text-center mx-auto">
            <h1 class="text-4xl font-extrabold text-[#4a8a4a] leading-tight mb-2">DASHBOARD ADMIN</h1>
            <p class="text-sm text-gray-600 max-w-lg mx-auto">Admin dapat mengkurasi produk serta mencatat riwayat perubahan status secara transparan.</p>
          </header>

          <section class="max-w-4xl border border-[#4a8a4a] rounded-xl p-6 bg-[#e6f0db] shadow-sm w-full mx-auto">
            <h2 class="font-bold text-lg text-[#5a5a5a] mb-6 text-center">Dashboard</h2>
            <article class="bg-[#f0f7e9] border border-[#a3c0d1] rounded-xl p-10 shadow-md text-center text-[#5a5a5a] text-base space-y-10 mx-auto max-w-xl">
              <p class="text-lg font-normal">Selamat Datang, Admin!</p>
              <p class="mx-auto max-w-md">Anda dapat memantau, meninjau, dan mengelola seluruh produk yang diajukan oleh para pedagang melalui sistem kurasi ini.</p>
              <p class="text-lg font-normal">Pilih Menu Sidebar</p>
            </article>
          </section>
        </main>

        <!-- Footer -->
      <footer class="bg-[#14532D] text-white py-4 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.</p>
      </footer>
      </div>
    </div>

  </body>
</html>
