<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="h-full flex flex-col bg-[#F8FFF9] text-gray-700">

  <!-- Header kosong -->
  <header class="h-16 border-b border-gray-200"></header>

  <div class="flex flex-1 overflow-hidden">

    <!-- Sidebar -->
    <div
      class="fixed inset-0 z-40 md:relative md:translate-x-0 transform transition-transform duration-300 ease-in-out"
      :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen || window.innerWidth >= 768 }"
    >
      <aside class="w-64 h-full bg-[#14532D] text-white p-6 space-y-6">
        <div class="flex justify-between items-center mb-6">
          <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-16" />
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

    <!-- Main Content -->
    <main class="flex-1 overflow-auto p-12">
      <section class="text-center max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold text-[#4a6c8a] mb-2">Hubungi Kami</h1>
        <p class="text-gray-500 mb-10">Kami siap mendengarkan pertanyaan, saran, dan referensi Anda</p>

        <div class="grid md:grid-cols-2 gap-6">
          <!-- Informasi Kontak -->
          <div class="bg-white p-6 rounded-xl shadow-md text-left">
            <h2 class="text-lg font-semibold text-[#4a6c8a] mb-4">Informasi Kontak Kami</h2>
            <p class="mb-3">
              <strong>Alamat</strong><br />
              Jl. Robert Walter Monginsidi, Bantul, Yogyakarta 55711
            </p>
            <p class="mb-3">
              <strong>Telepon</strong><br />
              (0274) 367509 Ext 434
            </p>
            <p class="mb-3">
              <strong>E-mail</strong><br />
              <a href="mailto:info@diskominfo.bantulkab.go.id" class="text-blue-600 hover:underline">info@diskominfo.bantulkab.go.id</a>
            </p>
            <p>
              <strong>Jam Operasional</strong><br />
              07.30 – 16.30
            </p>
          </div>

          <!-- Form Kontak -->
          <div class="bg-white p-6 rounded-xl shadow-md text-left">
            <h2 class="text-lg font-semibold text-[#4a6c8a] mb-4">Kirim Pesan</h2>
            <form>
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 rounded border border-gray-300 bg-gray-50" />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" placeholder="Masukkan Email Anda" class="w-full px-4 py-2 rounded border border-gray-300 bg-gray-50" />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Subjek</label>
                <input type="text" placeholder="Masukkan Subjek Anda" class="w-full px-4 py-2 rounded border border-gray-300 bg-gray-50" />
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Pesan</label>
                <textarea rows="4" placeholder="Tuliskan Pesan Anda" class="w-full px-4 py-2 rounded border border-gray-300 bg-gray-50"></textarea>
              </div>
              <button type="submit" class="bg-[#4a6c8a] text-white px-6 py-2 rounded hover:bg-[#3c5c73]">Kirim Pesan</button>
            </form>
          </div>
        </div>
      </section>
    </main>
  </div>

</body>
</html>
