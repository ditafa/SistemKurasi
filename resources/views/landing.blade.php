<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="h-full flex bg-[#F8FFF9] text-gray-700">

  <!-- Sidebar -->
  <div
    class="fixed inset-0 z-40 md:relative md:translate-x-0 transform transition-transform duration-300 ease-in-out"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen || window.innerWidth >= 768 }"
  >
    <aside class="w-64 h-full bg-[#14532D] text-white p-6 space-y-6">
      <div class="flex justify-between items-center mb-6">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-16">
        <button class="md:hidden" @click="sidebarOpen = false">✕</button>
      </div>

      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <div class="mt-4 border-t border-white/20 pt-4">
          <p class="text-xs mb-2">Masuk Sebagai:</p>
          <a href="/login-admin" class="block hover:text-green-200">Admin</a>
          <a href="/login-pedagang" class="block hover:text-green-200">Pedagang</a>
        </div>
      </nav>
    </aside>
  </div>

  <!-- Overlay -->
  <div
    class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-transition.opacity
  ></div>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col min-h-screen">
    <!-- Topbar Mobile -->
    <header class="md:hidden flex justify-between items-center p-4 bg-white shadow">
      <button @click="sidebarOpen = true">☰</button>
      <span class="font-bold text-[#14532D]">Kurasi Bantul</span>
    </header>

    <!-- Page Content -->
    <main class="flex-grow p-8">
      <!-- Judul besar -->
      <h3 class="text-5xl font-extrabold text-[#14532D] mb-4 tracking-tight leading-tight">
        <span class="bg-gradient-to-r from-green-600 to-lime-400 text-transparent bg-clip-text">
          Selamat Datang di Kurasi Bantul
        </span>
      </h3>

      <!-- Deskripsi -->
      <p class="mb-6 text-lg text-gray-600">Temukan produk lokal terbaik dengan sistem kurasi terpercaya dari Kabupaten Bantul.</p>

      <!-- Tombol -->
      <div class="space-x-4">
        <a href="/produk" class="bg-[#4CAF50] text-white px-6 py-3 rounded-lg shadow hover:bg-[#388E3C] transition">Jelajahi Sekarang</a>
        <a href="/pendaftaran" class="bg-white text-[#14532D] px-6 py-3 border border-[#14532D] rounded-lg shadow hover:bg-gray-100 transition">Daftar Sekarang</a>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#14532D] text-white text-sm py-6 text-center">
      <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
    </footer>

</body>
</html>
