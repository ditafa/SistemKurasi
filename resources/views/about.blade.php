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

  <!-- Main Content -->
  <main class="flex-1 overflow-auto">
    <!-- Header / Hero -->
    <header class="bg-white py-16 shadow">
      <div class="max-w-4xl mx-auto px-6 text-center">
        <h1 class="text-5xl font-extrabold text-[#14532D] mb-4 tracking-tight">
          Tentang Kami
        </h1>
        <p class="text-gray-700 max-w-xl mx-auto">
          Kenali lebih dekat misi, proses, dan semangat kami dalam mengkurasi produk lokal terbaik dari Bantul.
        </p>
      </div>
    </header>

    <!-- Nilai dan Tujuan -->
    <section class="py-20 bg-[#F8FFF9] max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <img src="{{ asset('images/illustration-tujuan.png') }}" alt="Ilustrasi Tujuan" class="rounded-lg shadow-lg w-full" />
      <div>
        <h2 class="text-3xl font-semibold text-[#14532D] mb-6">Nilai & Tujuan Kami</h2>
        <p class="text-gray-700 leading-relaxed text-lg">
          Kami percaya bahwa produk lokal memiliki potensi besar untuk bersaing di pasar nasional dan global.
          Melalui sistem kurasi yang ketat dan transparan, kami memastikan hanya produk terbaik yang kami tampilkan.
        </p>
      </div>
    </section>

    <!-- Proses Kurasi -->
    <section class="py-20 bg-white max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-semibold text-[#14532D] mb-12">Proses Kurasi Kami</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-[#DFF5E3] p-8 rounded-xl shadow-md">
          <h3 class="font-semibold text-[#14532D] mb-3 text-xl">1. Pendaftaran</h3>
          <p class="text-gray-700 text-base">Pedagang mendaftarkan produk mereka melalui platform online dengan detail lengkap.</p>
        </div>
        <div class="bg-[#DFF5E3] p-8 rounded-xl shadow-md">
          <h3 class="font-semibold text-[#14532D] mb-3 text-xl">2. Pemeriksaan</h3>
          <p class="text-gray-700 text-base">Tim kurator mengevaluasi kualitas, nilai jual, dan keaslian produk.</p>
        </div>
        <div class="bg-[#DFF5E3] p-8 rounded-xl shadow-md">
          <h3 class="font-semibold text-[#14532D] mb-3 text-xl">3. Persetujuan</h3>
          <p class="text-gray-700 text-base">Produk yang lolos akan dipublikasikan dan mendapatkan label “Terverifikasi”.</p>
        </div>
      </div>
    </section>

  
    <!-- Footer -->
    <footer class="bg-[#14532D] text-white text-center py-6 text-sm">
      <p>&copy; 2025 Kurasi Bantul. Semua Hak Dilindungi.</p>
    </footer>
  </main>
  
</body>
</html>
