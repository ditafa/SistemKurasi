<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-[#5a8a4f] text-white p-6">
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
            <div class="px-6 py-3 text-xs font-bold border-t border-white/20 mt-6">
                <span>2025 PemKab Bantul. All Rights Reserved.</span>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-extrabold text-[#5a8a4f] mb-1">DATA PRODUK</h1>
            <p class="text-xs text-[#6b6b6b] mb-6">Pedagang dapat mengajukan produk serta mencatat riwayat status secara transparan.</p>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter -->
            <form class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6" role="search">
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
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-[#5a8a4f]">
                        <tr>
                            <th class="px-4 py-2">Nama Produk</th>
                            <th class="px-4 py-2">Kategori</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Pedagang</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
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
                </table>
            </div>
        </main>
    </div>
</body>
</html>
