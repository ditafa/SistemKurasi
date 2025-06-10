<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak - Kurasi Bantul</title>
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
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200 font-semibold">Kontak</a>
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
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200 font-semibold">Kontak</a>
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
        <h1 class="text-3xl font-bold text-[#14532D] mb-6">Hubungi Kami</h1>

        <p class="mb-4 text-gray-700 leading-relaxed">
          Jika Anda memiliki pertanyaan, saran, atau ingin bekerja sama dengan Kurasi Bantul, jangan ragu untuk menghubungi kami melalui informasi berikut:
        </p>

        <div class="space-y-4 text-gray-800">
          <p><strong>Email:</strong> diskominfo@bantulkab.go.id</p>
          <p><strong>Telepon:</strong> (0274) 367174</p>
          <p><strong>Alamat:</strong> Jl. Jenderal Sudirman No.1, Bantul, Yogyakarta</p>
        </div>

        <div class="mt-8">
          <h2 class="text-xl font-semibold text-[#14532D] mb-2">Atau kirim pesan langsung:</h2>

          {{-- Form kontak --}}
          <form action="{{ route('kontak.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="nama" placeholder="Nama Anda" required
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"
              value="{{ old('nama') }}">
            
            <input type="email" name="email" placeholder="Email Anda" required
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"
              value="{{ old('email') }}">
            
            <textarea name="pesan" rows="4" placeholder="Pesan Anda" required
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">{{ old('pesan') }}</textarea>

            <button type="submit" class="bg-[#14532D] text-white px-6 py-2 rounded-lg hover:bg-[#0f3b1a] transition">
              Kirim
            </button>
          </form>

          {{-- Pesan sukses --}}
          @if(session('success'))
            <p class="mt-4 text-green-600">{{ session('success') }}</p>
          @endif

          {{-- Tampilkan error validasi --}}
          @if($errors->any())
            <div class="mt-4 text-red-600">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
        </div>
      </main>

      <!-- Footer -->
      <footer class="bg-[#14532D] text-white text-sm py-6 text-center">
        <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
      </footer>

    </div>
  </div>
</body>
</html>
