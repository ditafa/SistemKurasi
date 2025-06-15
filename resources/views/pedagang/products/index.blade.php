<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Pedagang - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-[#F8FFF9] text-gray-800 font-sans flex flex-col min-h-screen">
  <!-- Sidebar -->
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
          <a href="{{ route('pedagang.produk.index') }}" class="block px-3 py-2 rounded-md bg-white/10 font-bold">Daftar Produk</a>
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
  <main class="flex flex-col flex-1 ml-0 md:ml-64 px-6 md:px-16 py-12 w-full text-lg">
    <div class="max-w-7xl mx-auto w-full">
      <h1 class="text-4xl font-bold text-center text-green-800 mb-6">Daftar Produk Saya</h1>
      <p class="text-lg text-center text-gray-700 mb-8">Kelola produk yang sudah Anda upload. Anda dapat menambah, mengedit, dan menghapus produk Anda sendiri.</p>

      <div class="flex justify-end mb-8">
        <a href="{{ route('pedagang.produk.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 text-lg rounded-xl shadow-lg">Tambah Produk</a>
      </div>

      <!-- Filter -->
      <form method="GET" action="{{ route('pedagang.produk.index') }}" id="filter-form" class="bg-green-50 border border-green-300 rounded-xl shadow-md p-6 mb-10 flex flex-col md:flex-row flex-wrap gap-4 text-lg">
        <div class="relative flex-grow min-w-[200px]">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." onkeypress="handleSearch(event)" class="w-full pl-14 pr-5 py-3 border border-green-300 rounded-lg" />
          <span class="absolute inset-y-0 left-4 flex items-center text-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
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

      <!-- Tabel Produk -->
      <div class="overflow-x-auto bg-white border border-green-200 rounded-xl shadow-md text-base">
        <table class="min-w-full text-left">
          <thead class="bg-green-100 text-green-800 text-lg">
            <tr>
              <th class="px-6 py-4 border-b">Produk</th>
              <th class="px-6 py-4 border-b">Kategori</th>
              <th class="px-6 py-4 border-b">Harga</th>
              <th class="px-6 py-4 border-b">Status</th>
              <th class="px-6 py-4 border-b">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700 text-lg">
            @forelse($products as $product)
              <tr class="hover:bg-green-50 border-b">
                <td class="px-6 py-4">
                  <div class="flex gap-4">
                    <div class="w-16 h-16 rounded overflow-hidden bg-gray-100 flex items-center justify-center">
                      @if($product->first_photo)
                        <img src="{{ $product->first_photo->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                      @else
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                      @endif
                    </div>
                    <div>
                      <div class="font-semibold text-base">{{ $product->name }}</div>
                      <div class="text-sm text-gray-600">Jenis: {{ ucfirst($product->type) }}</div>
                      <div class="text-sm text-gray-500">
                        Stok:
                        @if ($product->type === 'variation')
                          {{ $product->variations->sum('stock') }}
                        @else
                          {{ $product->stock ?? 0 }}
                        @endif
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
                <td class="px-6 py-4">
                  @if ($product->type === 'variation')
                    @php
                      $min = $product->variations->min('price');
                      $max = $product->variations->max('price');
                    @endphp
                    @if ($min !== null && $max !== null)
                      @if ($min === $max)
                        Rp {{ number_format($min) }}
                      @else
                        Rp {{ number_format($min) }} - Rp {{ number_format($max) }}
                      @endif
                    @else
                      <span class="text-gray-400 italic">Belum ada harga</span>
                    @endif
                  @else
                    Rp {{ number_format($product->price ?? 0) }}
                  @endif
                </td>
                <td class="px-6 py-4">{{ $product->formatted_status ?? '-' }}</td>
                <td class="px-6 py-4 space-x-2">
                  <a href="{{ route('pedagang.produk.show', $product->id) }}" class="text-blue-600 hover:underline">Detail</a>
                  <a href="{{ route('pedagang.produk.edit', $product->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                  <form action="{{ route('pedagang.produk.destroy', $product->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-8 text-gray-500">Anda belum memiliki produk.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($products->hasPages())
        <div class="flex justify-center mt-8">
          {{ $products->links() }}
        </div>
      @endif
    </div>
  </main>

  <footer class="bg-[#14532D] text-white py-5 text-center mt-auto">
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
