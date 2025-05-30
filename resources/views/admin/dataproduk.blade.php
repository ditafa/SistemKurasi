<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Data Produk (Admin)</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

<<<<<<< HEAD
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama Produk</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Pedagang</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $product->pedagang->nama ?? '-' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $product->status }}</td>
                        <td class="px-4 py-2">
                        <a href="{{ route('admin.dataproduk.show', $product->id) }}" class="text-blue-600 hover:underline">Lihat Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
=======
                <!-- Navigation -->
            <nav class="flex flex-col space-y-4 text-sm font-medium">
            <a href="/" class="hover:text-green-200">Beranda</a>
            <a href="/about" class="hover:text-green-200">Tentang Kami</a>
            <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
            <a href="{{ route('admin.dataproduk.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Data Produk</a>
            <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
            <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
          </div>  
        </nav>
      </div>

      <!-- Footer -->
      <div class="px-6 py-3 text-xs font-bold flex items-center gap-2 border-t border-white/20">
        <i class="fas fa-eye"></i>
        <span>2025 PemKab Bantul. All Rights Reserved.</span>
      </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-10 ml-0 md:ml-64">
      <section class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-extrabold text-[#5a8a4f] mb-1">DATA PRODUK</h1>
        <p class="text-xs text-[#6b6b6b] mb-8 max-w-xl leading-tight">
          Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
        </p>

        <!-- Produk Box -->
        <section class="bg-[#e6f0d9] border border-[#5a8a4f] rounded-xl p-8 max-w-5xl shadow-inner">
          <h2 class="text-lg font-bold text-[#5a5a5a] mb-6">Daftar Produk</h2>

          <!-- Search and Filters -->
          <div class="bg-[#f0f7f3] border border-[#a9c6d1] rounded-xl p-6 shadow-md overflow-x-auto">
            <form class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6" role="search">
              <label for="search" class="sr-only">Cari produk</label>
              <div class="flex items-center border border-[#a9c6d1] rounded-md px-3 py-2 w-full sm:w-72 text-[#5a8a4f]">
                <i class="fas fa-search mr-2"></i>
                <input
                  type="search"
                  id="search"
                  name="search"
                  placeholder="Cari produk..."
                  class="w-full bg-transparent text-xs placeholder-[#a9c6d1] focus:outline-none"
                />
              </div>

              <select name="status" id="status" class="border border-[#a9c6d1] rounded-md px-3 py-2 text-xs text-[#5a8a4f] w-28">
                <option>Status</option>
                <option>Aktif</option>
                <option>Tidak Aktif</option>
              </select>

              <select name="kategori" id="kategori" class="border border-[#a9c6d1] rounded-md px-3 py-2 text-xs text-[#5a8a4f] w-28">
                <option>Kategori</option>
                <option>Makanan</option>
                <option>Minuman</option>
                <option>Kerajinan</option>
              </select>
            </form>

            <!-- Tabel Produk -->
            <table class="w-full text-xs text-[#5a8a4f] border-separate border-spacing-y-4">
              <thead>
                <tr class="font-bold text-[#8cae8a]">
                  <th class="text-left pl-3">Produk</th>
                  <th class="text-left">Kategori</th>
                  <th class="text-left">Harga</th>
                  <th class="text-left">Status</th>
                  <th class="text-left pr-3">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
                <tr class="border-t border-[#a9c6d1] h-12"></tr>
              </tbody>
>>>>>>> 0b8f075c0de126b9bf365118610af27c173bcc45
            </table>
        </div>
    </div>
</body>
</html>
