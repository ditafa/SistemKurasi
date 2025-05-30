<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-green-800 mb-4">Input Produk</h2>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan error -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pedagang.produk.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Produk -->
            <div>
                <label class="block text-sm font-bold mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-bold mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full p-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-bold mb-1">Harga (Rp)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Jenis Produk -->
            <div>
                <label class="block text-sm font-bold mb-1">Jenis Produk</label>
                <select name="type" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single</option>
                    <option value="variation" {{ old('type') == 'variation' ? 'selected' : '' }}>Variation</option>
                </select>
            </div>

            <!-- Status Kurasi -->
            <div>
                <label class="block text-sm font-bold mb-1">Status Kurasi</label>
                <select name="status" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="revisi" {{ old('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                    <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <!-- Kategori Produk -->
            <div>
                <label class="block text-sm font-bold mb-1">Kategori Produk</label>
                <select name="category_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            </div>

            <!-- Gambar Produk -->
            <div>
                <label class="block text-sm font-bold mb-1">Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Tombol -->
            <div class="text-right">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded font-semibold">
                    Tambah Produk
                </button>
            </div>
        </form>
    </div>

</body>
</html>
