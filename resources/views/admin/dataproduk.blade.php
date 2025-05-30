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
            </table>
        </div>
    </div>
</body>
</html>
