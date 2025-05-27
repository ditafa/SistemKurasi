<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Dashboard Kurasi Bantul</title>
  <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f3f5f8] text-gray-700">

  <!-- Navbar -->
  <nav class="bg-[#6b8ea1] flex items-center justify-between px-6 py-4 shadow-md">
    <div class="flex items-center space-x-3">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul" class="h-12">
    </div>
    <div class="hidden md:flex space-x-8 items-center text-white font-semibold">
      <a href="/" class="hover:text-gray-200">Beranda</a>
      <a href="/about" class="hover:text-gray-200">Tentang Kami</a>
      <a href="/kontak" class="hover:text-gray-200">Kontak</a>
      <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center text-white font-semibold hover:text-gray-200">
          Masuk
          <svg class="ml-1 w-4 h-4 fill-current" viewBox="0 0 20 20">
            <path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.06l3.71-3.83a.75.75 0 0 1 1.08 1.04l-4.25 4.39a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06z"/>
          </svg>
        </button>
        <div x-show="open" @click.away="open = false"
            x-transition
            class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-10 text-black">
          <a href="/login-admin" class="block px-4 py-2 hover:bg-gray-100">Admin</a>
          <a href="/login-pedagang" class="block px-4 py-2 hover:bg-gray-100">Pedagang</a>
        </div>
      </div>
    </div>
  </div>
</nav>

    <!-- Login Section -->
    <section class="flex justify-center items-center min-h-[70vh] px-4">
      <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-semibold text-[#4a6c8a] mb-6">Login Admin</h1>
        <form method="POST" action="{{ route('admin.login.submit') }}">
          @csrf
          <div class="mb-4 text-left">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" required
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan email">
          </div>

          <div class="mb-4 text-left">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Masukkan password">
          </div>

          @if($errors->any())
            <div class="mb-4 text-red-600 text-sm text-left">
              {{ $errors->first() }}
            </div>
          @endif

          <button type="submit"
            class="w-full bg-[#6b8ea1] text-white py-2 px-4 rounded-full hover:bg-[#55778c] transition duration-200">
            Login
          </button>
        </form>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-[#6b8ea1] text-white py-6 text-center text-sm">
    <p>&copy; 2025 PemKab Bantul. All Rights Reserved.</p>
    <div class="flex justify-center space-x-4 mt-2">
      <a href="https://www.facebook.com/kominfobantul" target="_blank" aria-label="Facebook">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M22 12a10 10 0 1 0-11.6 9.87v-7h-2v-2.87h2v-2.2c0-2 1.2-3.13 3-3.13.9 0 1.8.16 1.8.16v2h-1c-1 0-1.3.64-1.3 1.3v1.9h2.3L15 15h-2v7A10 10 0 0 0 22 12z"/>
        </svg>
      </a>
      <a href="https://www.instagram.com/diskominfobantul/" target="_blank" aria-label="Instagram">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm4.75-.88a.88.88 0 1 1 0 1.76.88.88 0 0 1 0-1.76Z"/>
        </svg>
      </a>
      <a href="https://www.youtube.com/results?search_query=diskominfo+bantul" target="_blank" aria-label="YouTube">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M10 15.5v-7l6 3.5-6 3.5ZM21.8 7.2c-.2-1.1-1.1-2-2.2-2.2C17.8 4.5 12 4.5 12 4.5s-5.8 0-7.6.5c-1.1.2-2 1.1-2.2 2.2C2 9 2 12 2 12s0 3 .2 4.8c.2 1.1 1.1 2 2.2 2.2 1.8.5 7.6.5 7.6.5s5.8 0 7.6-.5c1.1-.2 2-1.1 2.2-2.2.2-1.8.2-4.8.2-4.8s0-3-.2-4.8Z"/>
        </svg>
      </a>
    </div>
  </footer>

</body>
</html>
