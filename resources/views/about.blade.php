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

  <!-- Kontainer Utama -->
  <div class="flex flex-1 overflow-hidden">

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

    <!-- Konten Utama -->
    <main class="flex-1 overflow-auto">
      <!-- Hero Section -->
      <section class="bg-white py-16 shadow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
          <h1 class="text-4xl sm:text-5xl font-extrabold text-[#14532D] mb-4 tracking-tight">Tentang Kami</h1>
          <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
            Kenali lebih dekat misi, proses, dan semangat kami dalam mengkurasi produk lokal terbaik dari Bantul.
          </p>
        </div>
      </section>

      <!-- Tentang Kurasi Produk -->
      <section class="py-20 bg-gray-50 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto text-center">
          <h2 class="text-3xl font-bold text-[#14532D] mb-6">Apa Itu Kurasi Produk?</h2>
          <p class="text-gray-700 text-lg leading-relaxed mb-6">
            Kurasi produk adalah proses seleksi dan penilaian terhadap produk-produk yang akan ditampilkan kepada publik.
            Dalam konteks Kurasi Bantul, kami mengevaluasi kualitas, keaslian, dan potensi pasar dari produk lokal untuk memastikan hanya yang terbaik yang ditampilkan.
          </p>
          <ul class="text-left text-gray-700 space-y-3 max-w-3xl mx-auto">
            <li class="flex items-start gap-3">
              <span class="text-green-600 font-bold">✔</span>
              Memastikan produk memiliki kualitas yang layak jual.
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-600 font-bold">✔</span>
              Mendorong pelaku usaha untuk terus berinovasi.
            </li>
            <li class="flex items-start gap-3">
              <span class="text-green-600 font-bold">✔</span>
              Memberikan kepercayaan kepada konsumen akan keaslian produk.
            </li>
          </ul>
        </div>
      </section>

      <!-- Nilai & Tujuan -->
      <section class="py-20 bg-white px-4 sm:px-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
          <img src="{{ asset('images/illustration-tujuan.png') }}" alt="Ilustrasi Tujuan" class="w-full rounded-xl shadow-md">
          <div>
            <h2 class="text-3xl font-semibold text-[#14532D] mb-6">Nilai & Tujuan Kami</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
              Kami percaya bahwa produk lokal memiliki potensi besar untuk bersaing di pasar nasional dan global.
              Melalui sistem kurasi yang ketat dan transparan, kami memastikan hanya produk terbaik yang kami tampilkan.
            </p>
          </div>
        </div>
      </section>

      <!-- Proses Kurasi -->
      <section class="py-20 bg-[#F8FFF9] px-4 sm:px-6">
        <div class="max-w-7xl mx-auto text-center">
          <h2 class="text-3xl font-semibold text-[#14532D] mb-12">Proses Kurasi Kami</h2>
          <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white border border-green-100 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
              <h3 class="text-xl font-semibold text-[#14532D] mb-3">1. Pendaftaran</h3>
              <p class="text-gray-600 text-base">Pedagang mendaftarkan produk mereka secara online dengan detail yang lengkap dan akurat.</p>
            </div>
            <div class="bg-white border border-green-100 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
              <h3 class="text-xl font-semibold text-[#14532D] mb-3">2. Pemeriksaan</h3>
              <p class="text-gray-600 text-base">Tim kurator mengevaluasi kualitas, nilai jual, dan keaslian produk secara objektif.</p>
            </div>
            <div class="bg-white border border-green-100 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
              <h3 class="text-xl font-semibold text-[#14532D] mb-3">3. Persetujuan</h3>
              <p class="text-gray-600 text-base">Produk yang lolos proses kurasi akan mendapatkan label “Terverifikasi” dan dipublikasikan.</p>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-[#14532D] text-white text-center py-6 text-sm">
    <p>&copy; 2025 Kurasi Bantul. Semua Hak Dilindungi.</p>
  </footer>
</body>
</html>
