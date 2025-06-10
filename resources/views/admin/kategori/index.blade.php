<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kategori Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
  </head>
  <body
    class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col"
  >
    <div class="flex flex-1">
      <!-- Sidebar Desktop -->
      <aside
        class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10"
      >
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
              <a
                href="{{ route('admin.dashboard') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Dashboard</a
              >
              <a
                href="{{ route('admin.products.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Daftar Produk</a
              >
              <a
                href="{{ route('admin.kategori.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Kategori</a
              >
              <a
                href="{{ route('admin.notifikasi') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Notifikasi</a
              >
              <a
                href="{{ route('admin.statistik') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Statistik</a
              >
              <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button
                  type="submit"
                  class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition"
                >
                  Logout
                </button>
              </form>
            </div>
          </nav>
        </div>
      </aside>

      <!-- Sidebar Mobile -->
      <div
        class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
      >
        <div class="flex justify-between items-center mb-6">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-10"
          />
        </div>
        <nav class="flex flex-col space-y-3 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/20 my-4" />
          <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200"
            >Dashboard</a
          >
          <a href="{{ route('admin.products.index') }}" class="hover:text-green-200"
            >Daftar Produk</a
          >
          <a href="{{ route('admin.kategori.index') }}" class="hover:text-green-200"
            >Kategori</a
          >
          <a href="{{ route('admin.notifikasi') }}" class="hover:text-green-200"
            >Notifikasi</a
          >
          <a href="{{ route('admin.statistik') }}" class="hover:text-green-200"
            >Statistik</a
          >
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-left hover:text-green-200">
              Logout
            </button>
          </form>
        </nav>
      </div>

      <!-- Content Area -->
      <main class="flex-1 flex flex-col ml-0 md:ml-64">
        <div class="p-6 flex-grow">
          <a
            href="{{ route('admin.kategori.create') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4"
            >+ Tambah Kategori</a
          >

          <h1 class="text-2xl font-semibold mb-4">Kategori</h1>

          <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full text-left border border-gray-300">
              <thead class="bg-gray-200">
                <tr>
                  <th class="px-4 py-2 border-b">Nama Kategori</th>
                  <th class="px-4 py-2 border-b">Induk</th>
                  <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($categories as $kategori)
                <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 border-b">{{ $kategori->name }}</td>
                  <td class="px-4 py-2 border-b">{{ $kategori->parent?->name ?? '-' }}</td>
                  <td class="px-4 py-2 border-b space-x-2">
                    <a
                      href="{{ route('admin.kategori.edit', $kategori) }}"
                      class="text-blue-600 hover:underline"
                      >Edit</a
                    >
                    <form
                      action="{{ route('admin.kategori.destroy', $kategori) }}"
                      method="POST"
                      class="inline"
                    >
                      @csrf
                      @method('DELETE')
                      <button
                        type="submit"
                        onclick="return confirm('Yakin hapus kategori ini?')"
                        class="text-red-600 hover:underline"
                      >
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                    Belum ada kategori
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Footer -->
        <footer
          class="bg-[#14532D] border-t p-4 text-center text-sm text-white mt-auto"
        >
          &copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.
        </footer>
      </main>
    </div>
  </body>
</html>
