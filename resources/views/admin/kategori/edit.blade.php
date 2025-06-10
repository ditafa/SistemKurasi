<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

  <!-- Sidebar -->
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10">
    <div>
      <div class="flex items-center justify-between mb-10">
        <img
          src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
          alt="Logo"
          class="h-12"
        />
      </div>
      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <hr class="border-white/40 my-6" />
        <div class="space-y-3">
          <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
          <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
          <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
          <a href="{{ route('admin.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Notifikasi</a>
          <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
          </form>
        </div>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <main class="flex-1 md:ml-64 p-6">
    <div class="mx-auto my-10 p-6 bg-white rounded shadow w-full max-w-lg">
      <h1 class="text-2xl font-semibold mb-6">Edit Kategori</h1>

      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label for="name" class="block mb-1 font-medium">Nama Kategori</label>
          <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $kategori->name) }}"
            required
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
          />
        </div>

        <div>
          <label for="parent_name" class="block mb-1 font-medium">Kategori Induk (Bisa ketik)</label>
          <input
            list="parentCategories"
            name="parent_name"
            id="parent_name"
            value="{{ old('parent_name', optional($kategori->parent)->name) }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
            autocomplete="off"
          />
          <datalist id="parentCategories">
            @foreach ($categories as $category)
              <option value="{{ $category->name }}"></option>
            @endforeach
          </datalist>
        </div>

        <div class="flex justify-between">
          <a href="{{ route('admin.kategori.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
          <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Perbarui</button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
      <footer class="bg-[#14532D] border-t p-4 text-center text-sm text-white">
        &copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.
      </footer>
</body>
</html>
