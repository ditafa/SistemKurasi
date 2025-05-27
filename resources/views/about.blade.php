<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami - Kurasi Bantul</title>
  <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#DFF5E3] text-gray-700">

  <!-- Navbar -->
  <nav class="bg-[#4CAF50] text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul" class="h-16">
      <div class="hidden md:flex space-x-6 font-medium">
        
      <!-- Navigation -->
      <div class="hidden md:flex items-center space-x-8 text-white font-medium text-sm">
        <a href="/" class="hover:text-gray-200 transition">Beranda</a>
        <a href="/about" class="hover:text-gray-200 transition">Tentang Kami</a>
        <a href="/kontak" class="hover:text-gray-200 transition">Kontak</a>
        
        <!-- Dropdown -->
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex items-center hover:text-gray-200 transition">
            Masuk
            <svg class="ml-1 w-4 h-4 fill-current" viewBox="0 0 20 20">
              <path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.06l3.71-3.83a.75.75 0 0 1 1.08 1.04l-4.25 4.39a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06z"/>
            </svg>
          </button>
          <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-10 text-black">
            <a href="/login-admin" class="block px-4 py-2 hover:bg-gray-100">Admin</a>
            <a href="/login-pedagang" class="block px-4 py-2 hover:bg-gray-100">Pedagang</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero / Judul Halaman -->
  <header class="bg-white py-12 shadow">
    <div class="max-w-4xl mx-auto text-center px-4">
      <h1 class="text-4xl font-bold text-[#14532D] mb-2">Tentang Kami</h1>
      <p class="text-[#6B7280]">Kenali lebih dekat misi, proses, dan semangat kami dalam mengkurasi produk lokal terbaik dari Bantul.</p>
    </div>
  </header>

  <!-- Nilai dan Tujuan -->
  <section class="py-16 bg-[#F8FFF9]">
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
      <img src="{{ asset('images/illustration-tujuan.png') }}" class="w-full rounded-lg shadow" alt="Ilustrasi Tujuan">
      <div>
        <h2 class="text-2xl font-semibold text-[#14532D] mb-3">Nilai & Tujuan Kami</h2>
        <p class="text-[#6B7280] leading-relaxed">
          Kami percaya bahwa produk lokal memiliki potensi besar untuk bersaing di pasar nasional dan global.
          Melalui sistem kurasi yang ketat dan transparan, kami memastikan hanya produk terbaik yang kami tampilkan.
        </p>
      </div>
    </div>
  </section>

  <!-- Proses Kurasi -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-2xl font-semibold text-[#14532D] mb-8">Proses Kurasi Kami</h2>
      <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-[#DFF5E3] p-6 rounded-xl shadow">
          <h3 class="font-semibold text-[#14532D] mb-2">1. Pendaftaran</h3>
          <p class="text-sm text-gray-600">Pedagang mendaftarkan produk mereka melalui platform online dengan detail lengkap.</p>
        </div>
        <div class="bg-[#DFF5E3] p-6 rounded-xl shadow">
          <h3 class="font-semibold text-[#14532D] mb-2">2. Pemeriksaan</h3>
          <p class="text-sm text-gray-600">Tim kurator mengevaluasi kualitas, nilai jual, dan keaslian produk.</p>
        </div>
        <div class="bg-[#DFF5E3] p-6 rounded-xl shadow">
          <h3 class="font-semibold text-[#14532D] mb-2">3. Persetujuan</h3>
          <p class="text-sm text-gray-600">Produk yang lolos akan dipublikasikan dan mendapatkan label “Terverifikasi”.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="bg-[#4CAF50] py-12 text-white text-center">
    <h2 class="text-2xl font-semibold mb-2">Ingin Produk Anda Tampil di Sini?</h2>
    <p class="mb-6">Daftarkan sekarang dan jadilah bagian dari UMKM unggulan Bantul.</p>
    <a href="/pendaftaran" class="bg-white text-[#14532D] px-6 py-2 rounded-full hover:bg-yellow-100 transition">Daftar Sekarang</a>
  </section>

  <!-- Footer -->
  <footer class="bg-[#14532D] text-white text-center py-6 text-sm">
    <p>&copy; 2025 PemKab Bantul. All Rights Reserved.</p>
  </footer>

</body>
</html>
