<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Produk - Kurasi Bantul</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>

  <body class="bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">
    <!-- Sidebar (desktop) -->
    <aside
      class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-40"
    >
      <div>
        <!-- Logo -->
        <div class="flex items-center justify-between mb-10">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-11"
          />
        </div>

        <!-- Navigasi -->
        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a
              href="{{ route('pedagang.dashboard') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Dashboard</a
            >
            <a
              href="{{ route('pedagang.produk.index') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Daftar Produk</a
            >
            <a
              href="{{ route('pedagang.notifikasi') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Notifikasi</a
            >
            <form action="{{ route('pedagang.logout') }}" method="POST">
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

    <main class="flex-grow md:ml-64 p-6">
      <!-- Success Message -->
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      <!-- Error Messages -->
      @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Product Edit Form -->
      <form
        action="{{ route('pedagang.produk.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6 max-w-3xl mx-auto bg-white p-8 rounded-lg shadow"
      >
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div>
          <label for="name" class="block font-medium text-gray-700">Nama Produk</label>
          <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $product->name) }}"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
            required
          />
        </div>

        <!-- Product Description -->
        <div>
          <label for="description" class="block font-medium text-gray-700">Deskripsi</label>
          <textarea
            name="description"
            id="description"
            rows="4"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
          >{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Product Price -->
        <div>
          <label for="price" class="block font-medium text-gray-700">Harga</label>
          <input
            type="number"
            name="price"
            id="price"
            value="{{ old('price', $product->price) }}"
            step="0.01"
            min="0"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
            required
          />
        </div>

        <!-- Product Type -->
        <div>
          <label for="type" class="block font-medium text-gray-700">Tipe</label>
          <select
            name="type"
            id="type"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
            required
          >
            <option value="single" {{ old('type', $product->type) == 'single' ? 'selected' : '' }}>Single</option>
            <option value="variation" {{ old('type', $product->type) == 'variation' ? 'selected' : '' }}>Variation</option>
          </select>
        </div>

        <!-- Product Status -->
        <div>
          <label for="status" class="block font-medium text-gray-700">Status</label>
          <select
            name="status"
            id="status"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
            required
          >
            <option value="diajukan" {{ old('status', $product->status) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
            <option value="diterima" {{ old('status', $product->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="ditolak" {{ old('status', $product->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            <option value="revisi" {{ old('status', $product->status) == 'revisi' ? 'selected' : '' }}>Revisi</option>
          </select>
        </div>

        <!-- Product Category -->
        <div>
          <label for="category_id" class="block font-medium text-gray-700">Kategori</label>
          <select
            name="category_id"
            id="category_id"
            class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
            required
          >
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Product Image -->
        <div>
          <label for="gambar" class="block font-medium text-gray-700">Gambar Produk (ubah jika perlu)</label>
          <input
            type="file"
            name="gambar"
            id="gambar"
            class="mt-1 block w-full p-2"
          />
          @if($product->gambar)
            <img
              src="{{ asset('storage/' . $product->gambar) }}"
              alt="Gambar Produk"
              class="mt-2 max-w-xs rounded"
            />
          @endif
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
          >
            Update Produk
          </button>
        </div>
      </form>
    </main>
  </body>
</html>
