<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Produk Pedagang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col">

  <div class="flex flex-1">

    <!-- Sidebar Desktop -->
    <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10">
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
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Daftar Produk</a>
            <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10">Kategori</a>
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
    <div class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
         :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
      <div class="flex justify-between items-center mb-6">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-10" />
      </div>
      <nav class="flex flex-col space-y-3 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <hr class="border-white/20 my-4" />
        <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200">Dashboard</a>
        <a href="{{ route('admin.products.index') }}" class="hover:text-green-200">Daftar Produk</a>
        <a href="{{ route('admin.kategori.index') }}" class="hover:text-green-200">Kategori</a>
        <a href="{{ route('admin.statistik') }}" class="hover:text-green-200">Statistik</a>
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="text-left hover:text-green-200">Logout</button>
        </form>
      </nav>
    </div>

    <!-- Konten Utama -->
    <main class="flex-1 p-8 md:ml-64">
      <h2 class="text-2xl font-bold text-green-900 mb-6">Daftar Produk</h2>

      <!-- Tab Filter -->
      <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ route('pedagang.produk.index') }}"
           class="px-4 py-2 rounded-full text-sm font-medium border {{ request('status') === null ? 'bg-green-700 text-white' : 'bg-white text-gray-700' }}">
          Semua Produk
        </a>
        <a href="{{ route('pedagang.produk.index', ['status' => 'diajukan']) }}"
           class="px-4 py-2 rounded-full text-sm font-medium border {{ request('status') === 'diajukan' ? 'bg-green-700 text-white' : 'bg-white text-gray-700' }}">
          Menunggu Verifikasi
        </a>
        <a href="{{ route('pedagang.produk.index', ['status' => 'nonaktif']) }}"
           class="px-4 py-2 rounded-full text-sm font-medium border {{ request('status') === 'nonaktif' ? 'bg-green-700 text-white' : 'bg-white text-gray-700' }}">
          Nonaktif
        </a>
      </div>

      <div class="flex justify-end w-full mb-4">
        <a href="{{ route('pedagang.produk.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-medium shadow">
          <i class="fas fa-plus-circle mr-2"></i>Tambah Produk
        </a>
      </div>

      <!-- Pencarian -->
      {{-- Filter Box --}}
      <form method="GET" action="{{ route('pedagang.produk.index') }}" id="filter-form" class="bg-green-50 border border-green-300 rounded-xl shadow-md p-6 mb-10 flex flex-col md:flex-row flex-wrap gap-4 text-lg w-full">
        <div class="relative flex-grow min-w-[200px]">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." onkeypress="handleSearch(event)" class="w-full pl-14 pr-5 py-3 border border-green-300 rounded-lg" />
          <span class="absolute inset-y-0 left-4 flex items-center text-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="7" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
          </span>
        </div>
        <div class="min-w-[180px]">
          <select name="status" class="w-full px-4 py-3 border border-green-300 rounded-lg">
            <option value="">Semua Status</option>
            <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
          </select>
        </div>

        <div class="min-w-[180px]">
          <select name="category_id" class="w-full px-4 py-3 border border-green-300 rounded-lg">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg">Filter</button>
        </div>
      </form>
      </form>

      <!-- Tabel Produk -->
      <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-left text-sm border border-gray-200">
          <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
              <th class="px-4 py-3 w-[40%]">Info Produk</th>
              <th class="px-4 py-3">Kategori</th>
              <th class="px-4 py-3">Harga</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $product)
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-4 flex items-start gap-4">
                  @if($product->first_photo)
                    <img src="{{ $product->first_photo->url }}" class="w-16 h-16 object-cover rounded-md shadow-sm" alt="{{ $product->name }}">
                  @else
                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md">
                      <span class="text-gray-500 text-xs">Tidak ada gambar</span>
                    </div>
                  @endif
                  <div>
                    <div class="font-semibold text-blue-600 truncate w-40" title="{{ $product->name }}">
                      {{ $product->name }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Jenis: {{ $product->type === 'variation' ? 'Variasi' : 'Single' }}</div>
                  </div>
                </td>
                <td class="px-4 py-4">{{ $product->rootCategory->name ?? 'Tanpa Kategori' }}</td>
                <td class="px-4 py-4 font-medium">
                  @if($product->type === 'variation' && optional($product->variationCombinations)->count())
                    @php
                      $prices = $product->variationCombinations->pluck('price')->sort();
                    @endphp
                    Rp {{ number_format($prices->first(), 0, ',', '.') }} - Rp {{ number_format($prices->last(), 0, ',', '.') }}
                  @else
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  @endif
                </td>
                @php
                  $statusRaw = strtolower($product->latestHistory->status ?? 'diajukan');
                  $status = ucwords($statusRaw);
                  $color = match($statusRaw) {
                    'diterima' => 'bg-green-500',
                    'ditolak' => 'bg-red-500',
                    'diterima dengan revisi' => 'bg-yellow-500',
                    'diajukan' => 'bg-blue-500',
                    default => 'bg-gray-400',
                  };
                @endphp
                <td class="px-4 py-4">
                  <span class="inline-block px-3 py-1 rounded-full text-xs font-medium text-white {{ $color }}">
                    {{ $status }}
                  </span>
                </td>
                <td class="px-4 py-4">
                  <div class="flex space-x-2">
                    <a href="{{ route('pedagang.produk.show', $product->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    <a href="{{ route('pedagang.produk.edit', $product->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                    <form action="{{ route('pedagang.produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada produk ditemukan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6">
        {{ $products->withQueryString()->links() }}
      </div>
    </main>
  </div>

</body>
</html>
