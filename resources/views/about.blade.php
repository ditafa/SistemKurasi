<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen flex flex-col bg-[#F8FFF9] text-gray-700">

  <div class="flex flex-1">

    <!-- Sidebar Desktop -->
    <aside class="hidden md:block w-64 bg-[#14532D] text-white p-6">
      <div class="flex flex-col h-full">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12 mb-8">

        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200 font-semibold">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <div class="mt-6 border-t border-white/20 pt-4">
            <p class="text-xs mb-2">Masuk Sebagai:</p>
            <a href="/login-admin" class="block hover:text-green-200">Admin</a>
            <a href="/login-pedagang" class="block hover:text-green-200">Pedagang</a>
          </div>
        </nav>
      </div>
    </aside>

    <!-- Sidebar Mobile Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- Sidebar Mobile Slide -->
    <div
      class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
      :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
    >
      <div class="flex justify-between items-center mb-6">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12">
        <button class="text-white text-2xl font-bold" @click="sidebarOpen = false">×</button>
      </div>
      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200 font-semibold">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <div class="mt-4 border-t border-white/20 pt-4">
          <p class="text-xs mb-2">Masuk Sebagai:</p>
          <a href="/login-admin" class="block hover:text-green-200">Admin</a>
          <a href="/login-pedagang" class="block hover:text-green-200">Pedagang</a>
        </div>
      </nav>
    </div>

    <!-- Konten Utama -->
    <div class="flex flex-col flex-1 min-h-screen">

      <!-- Header Mobile -->
      <header class="md:hidden flex justify-between items-center p-4 bg-white shadow">
        <button @click="sidebarOpen = true" class="text-2xl">☰</button>
        <span class="font-bold text-[#14532D]">Kurasi Bantul</span>
      </header>

      <!-- Konten -->
      <main class="flex-grow p-8 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-[#14532D] mb-4">Tentang Kami</h1>
        <p class="text-gray-700 mb-4 leading-relaxed">
          Kurasi Bantul adalah platform digital yang bertujuan untuk membantu pelaku UMKM lokal di Kabupaten Bantul
          dalam memasarkan produk-produk unggulan mereka melalui proses kurasi yang adil, transparan, dan terstandarisasi.
        </p>
        <p class="text-gray-700 mb-4 leading-relaxed">
          Kami bekerja sama dengan Dinas Komunikasi dan Informatika Kabupaten Bantul untuk memberikan ruang promosi
          serta dukungan teknis dan digitalisasi kepada para pedagang agar siap bersaing di era industri 4.0.
        </p>
        <p class="text-gray-700 mb-4 leading-relaxed">
          Dengan semangat gotong royong, kami berharap Kurasi Bantul menjadi jembatan antara UMKM dan masyarakat luas
          dalam mengapresiasi karya lokal berkualitas tinggi.
        </p>
      </main>

      <!-- Footer -->
      <footer class="bg-[#14532D] text-white py-4 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.</p>
      </footer>

    </div>
  </div>
</body>
</html>
