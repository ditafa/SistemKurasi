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
          <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12"/>
        </div>
        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Daftar Produk</a>
            <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Kategori</a>
            <a href="{{ route('admin.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Notifikasi</a>
            <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Statistik</a>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10">Logout</button>
            </form>
          </div>
        </nav>
      </div>
    </aside>

    <!-- Sidebar Mobile -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity></div>
    <div class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
         :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
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
      <div class="max-w-6xl mx-auto">
        <a href="{{ route('admin.kategori.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
          + Tambah Kategori
        </a>

        <h1 class="text-2xl font-semibold mb-4">Kategori</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded">
          <table class="min-w-full text-left border border-gray-300">
            <thead class="bg-gray-200">
              <tr>
                <th class="px-4 py-2 border-b">Sub Kategori</th>
                <th class="px-4 py-2 border-b">Induk Kategori</th>
                <th class="px-4 py-2 border-b">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $kategori)
                <!-- Induk kategori -->
                <tr>
                  <td class="px-4 py-2 font-semibold">{{ $kategori->name }}</td>
                  <td class="px-4 py-2">–</td>
                  <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin?')" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                  </td>
                </tr>

                <!-- Subkategori -->
                @foreach ($kategori->children as $sub)
                  <tr class="bg-gray-50">
                    <td class="px-4 py-2 pl-8">↳ {{ $sub->name }}</td>
                    <td class="px-4 py-2">{{ $kategori->name }}</td>
                    <td class="px-4 py-2 space-x-2">
                      <a href="{{ route('admin.kategori.edit', $sub) }}" class="text-blue-600 hover:underline">Edit</a>
                      <form action="{{ route('admin.kategori.destroy', $sub) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin?')" class="text-red-600 hover:underline">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @empty
                <tr>
                  <td colspan="3" class="text-center py-4">Belum ada kategori</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-[#14532D] border-t p-4 text-center text-sm text-white mt-auto">
    &copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.
  </footer>
</body>
</html>
