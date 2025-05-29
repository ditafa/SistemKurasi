<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Pedagang - Kurasi Bantul</title>
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
        <img
          src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
          alt="Logo"
          class="h-16"
        />
        <button class="md:hidden text-white text-2xl font-bold" @click="sidebarOpen = false" aria-label="Close sidebar">×</button>
      </div>

      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200 transition">Beranda</a>
        <a href="/about" class="hover:text-green-200 transition">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200 transition">Kontak</a>
        <div class="mt-6 border-t border-white/20 pt-4">
          <p class="text-xs mb-2">Masuk Sebagai:</p>
          <a href="/login-admin" class="block hover:text-green-200 transition">Admin</a>
          <a href="/login-pedagang" class="block hover:text-green-200 transition">Pedagang</a>
        </div>
      </nav>
    </aside>
  </div>

  <!-- Login Section -->
  <section class="flex justify-center items-center flex-grow px-6 py-12 min-h-[70vh]">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md text-center">
      <h1 class="text-2xl font-semibold text-[#14532D] mb-6">Login Pedagang</h1>

      <form method="POST" action="{{ route('pedagang.login.submit') }}">
        @csrf
        <div class="mb-4 text-left">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            required
            placeholder="Masukkan email"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#14532D] focus:border-transparent"
          />
        </div>

        <div class="mb-4 text-left">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            required
            placeholder="Masukkan password"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#14532D] focus:border-transparent"
          />
        </div>

        @if($errors->any())
          <div class="mb-4 text-red-600 text-sm text-left">
            {{ $errors->first() }}
          </div>
        @endif

        <button
          type="submit"
          class="w-full bg-[#14532D] text-white py-2 px-4 rounded-full hover:bg-[#10421a] transition duration-200"
        >
          Login
        </button>
      </form>
    </div>
  </section>

</body>
</html>
