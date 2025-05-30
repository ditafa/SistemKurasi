<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Detail Produk</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
        <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
        <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
        <p><strong>Status Saat Ini:</strong> <span class="font-semibold">{{ $product->status }}</span></p>

        <form action="{{ route('admin.dataproduk.kurasi', $product->id) }}" method="POST" class="mt-4">
            @csrf
            <label class="block mb-2 font-semibold">Ubah Status:</label>
            <select name="status" class="w-full border rounded p-2 mb-4">
                <option value="diterima" @selected($product->status === 'diterima')>Diterima</option>
                <option value="ditolak" @selected($product->status === 'ditolak')>Ditolak</option>
                <option value="revisi" @selected($product->status === 'revisi')>Revisi</option>
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Kurasi
            </button>
        </form>
    </div>
</body>
</html>
