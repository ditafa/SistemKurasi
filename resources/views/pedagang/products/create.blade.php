<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-10">

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">
        <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">Form Tambah Produk</h1>

        <form action="{{ route('pedagang.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Foto Produk --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Produk</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-green-600 focus:border-green-600">
            </div>

            {{-- Nama Produk --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name"
                       class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600" required>
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" required
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->getFullCategoryPath() }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600" required></textarea>
            </div>

            {{-- Warna --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                <input type="text" name="color"
                       class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600">
            </div>

            {{-- Ukuran --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                <input type="text" name="size"
                       class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600">
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price"
                       class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-green-600 focus:border-green-600" required>
            </div>

            {{-- Tombol --}}
            <div class="text-center">
                <button type="submit"
                        class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Tambah Produk
                </button>
            </div>

            @if (session('success'))
              <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                  {{ session('success') }}
              </div>
          @endif
        </form>
    </div>

</body>
</html>
