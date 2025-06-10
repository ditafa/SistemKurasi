<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Pedagang - Daftar Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

  <!-- Sidebar Desktop -->
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6">
    <div>
      <div class="flex items-center justify-between mb-10">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12" />
      </div>

      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <hr class="border-white/40 my-6" />
        <div class="space-y-3">
          <a href="{{ route('pedagang.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Dashboard</a>
          <a href="{{ route('pedagang.produk.index') }}" class="block px-3 py-2 rounded-md bg-white/10">Daftar Produk</a>
          <a href="{{ route('pedagang.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Notifikasi</a>
          <a href="{{ route('pedagang.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Statistik</a>
          <form action="{{ route('pedagang.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10">Logout</button>
          </form>
        </div>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex flex-col items-center justify-start flex-1 px-6 md:px-16 py-10 w-full ml-64 max-w-7xl">
    <!-- Container tengah -->
    <div class="w-full max-w-4xl mx-auto">
      <h1 class="text-3xl font-semibold text-center mb-4 text-green-800">Daftar Produk Saya</h1>
      <p class="text-base text-center text-gray-700 mb-6">
        Kelola produk yang sudah Anda upload. Anda dapat menambah, mengedit, dan menghapus produk Anda sendiri.
      </p>

      <!-- Tombol Tambah -->
      <div class="flex justify-end mb-6">
        <a href="{{ route('pedagang.produk.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md">
          Tambah Produk
        </a>
      </div>

      <!-- Form Filter -->
      <div class="bg-green-50 border border-green-300 rounded-lg shadow-sm p-6 mb-10">
        <form id="filter-form" action="{{ route('pedagang.produk.index') }}" method="GET"
              class="flex flex-col md:flex-row gap-4 mb-8">
          <div class="relative flex-grow">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}"
                   onkeypress="handleSearch(event)"
                   class="w-full pl-12 pr-5 py-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" />
            <span class="absolute inset-y-0 left-3 flex items-center text-green-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
              </svg>
            </span>
          </div>
          <button type="submit"
                  class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg">
            Cari
          </button>
        </form>

        <!-- Produk Tabel -->
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white border border-green-200 rounded-lg shadow-sm text-sm">
            <thead class="bg-green-100 text-green-800 text-left">
              <tr>
                <th class="px-4 py-3 border-b">Produk</th>
                <th class="px-4 py-3 border-b">Kategori</th>
                <th class="px-4 py-3 border-b">Harga</th>
                <th class="px-4 py-3 border-b">Status</th>
                <th class="px-4 py-3 border-b">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              @forelse($products as $product)
                <tr class="hover:bg-green-50">
                  <!-- Produk -->
                  <td class="px-4 py-3 flex items-center gap-3">
                    <div class="w-12 h-12 rounded overflow-hidden bg-gray-100 flex items-center justify-center">
                      @if($product->first_photo)
                        <img src="{{ $product->first_photo->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                      @else
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                      @endif
                    </div>
                    <span>{{ $product->name }}</span>
                  </td>

                  <!-- Kategori -->
                  <td class="px-4 py-3">
                    {{ $product->rootCategory->name ?? 'Tanpa Kategori' }}
                  </td>

                  <!-- Harga -->
                  <td class="px-4 py-3 font-medium text-green-700">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  </td>

                  <!-- Status -->
                  <td class="px-4 py-3">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                      {{ $product->status === 'diterima' ? 'bg-green-100 text-green-800' :
                         ($product->status === 'ditolak' ? 'bg-red-100 text-red-800' :
                         'bg-yellow-100 text-yellow-800') }}">
                      {{ ucfirst($product->status) }}
                    </span>
                  </td>

                  <!-- Aksi -->
                  <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                    <a href="{{ route('pedagang.produk.edit', $product->id) }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded text-xs font-medium">
                      Edit
                    </a>
                    <form action="{{ route('pedagang.produk.destroy', $product->id) }}" method="POST" class="inline-block"
                          onsubmit="return confirm('Yakin hapus produk ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-xs font-medium">
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-6 text-gray-500">Anda belum memiliki produk.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
          <div class="flex justify-center mt-6 gap-2">
            {{-- Previous --}}
            @if ($products->onFirstPage())
              <button disabled class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-white">‹</button>
            @else
              <a href="{{ $products->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">‹</a>
            @endif

            {{-- Pages --}}
            @foreach ($products->getUrlRange(max($products->currentPage() - 2, 1), min($products->currentPage() + 2, $products->lastPage())) as $page => $url)
              @if ($page == $products->currentPage())
                <button disabled class="w-10 h-10 border border-green-600 text-green-600 bg-green-100 rounded-md">{{ $page }}</button>
              @else
                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">{{ $page }}</a>
              @endif
            @endforeach

            {{-- Next --}}
            @if ($products->hasMorePages())
              <a href="{{ $products->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">›</a>
            @else
              <button disabled class="w-10 h-10 border border-gray-300 text-gray-400 bg-white rounded-md">›</button>
            @endif
          </div>
        @endif
      </div>
    </div>
  </main>

  <footer class="bg-[#14532D] text-white py-4 text-center mt-auto">
    <p class="text-sm">&copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.</p>
  </footer>

  <script>
    function handleSearch(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("filter-form").submit();
      }
    }
  </script>

</body>
</html>
