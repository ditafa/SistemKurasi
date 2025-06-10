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
              class="h-12"
            />
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
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
      >
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

      <!-- Main Content -->
      <main class="flex-1 md:ml-64 p-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
          <h1 class="text-2xl font-bold mb-6">Notifikasi Kurasi Produk</h1>

          <form method="POST" action="{{ route('admin.notifikasi.markAllAsRead') }}">
            @csrf
            <button type="submit" class="mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
              Tandai Semua Sudah Dibaca
            </button>
          </form>

          <ul class="space-y-4">
            @forelse ($notifikasis as $notifikasi)
              <li class="p-4 border rounded @if(!$notifikasi->read_at) bg-yellow-100 @else bg-gray-100 @endif">
                <div class="flex justify-between items-center">
                  <div>
                    <p class="text-sm text-gray-800">{{ $notifikasi->data['message'] ?? 'Notifikasi tanpa pesan.' }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $notifikasi->created_at->diffForHumans() }}</p>
                  </div>
                  @if (!$notifikasi->read_at)
                    <form method="POST" action="{{ route('admin.notifikasi.markAsRead', $notifikasi->id) }}">
                      @csrf
                      @method('PATCH')
                      <button class="text-sm text-blue-600 hover:underline">Tandai Dibaca</button>
                    </form>
                  @endif
                </div>
              </li>
            @empty
              <p class="text-gray-600">Belum ada notifikasi.</p>
            @endforelse
          </ul>

          <div class="mt-6">
            {{ $notifikasis->links() }}
          </div>
        </div>
      </main>

    </div>

    <!-- Footer -->
    <footer class="bg-[#14532D] text-white text-sm py-4 text-center">
      <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
    </footer>

  </body>
</html>
