<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col">

  <main class="p-6 flex-grow max-w-2xl mx-auto">
    <a href="{{ route('admin.kategori.index') }}" class="text-blue-600 hover:underline mb-6 inline-block">← Kembali ke daftar kategori</a>

    <h1 class="text-2xl font-semibold mb-6">Tambah Kategori</h1>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.kategori.store') }}" method="POST" class="bg-white shadow rounded p-6 space-y-4">
      @csrf

      <!-- Nama Kategori -->
      <div>
        <label for="name" class="block font-medium mb-1">Nama Kategori <span class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}"
               class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
      </div>

      <!-- Induk Kategori -->
      <div>
        <label for="parent_name" class="block font-medium mb-1">Induk Kategori (Opsional)</label>
        <select name="parent_name" id="parent_name"
                class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
          <option value="">-- Tidak ada (Kategori Induk) --</option>
          @foreach ($categories as $parent)
            <option value="{{ $parent->name }}" {{ old('parent_name') == $parent->name ? 'selected' : '' }}>
              {{ $parent->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Tombol Submit -->
      <div class="pt-4">
        <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
          Simpan
        </button>
      </div>
    </form>
  </main>

  <footer class="bg-[#14532D] border-t p-4 text-center text-sm text-white mt-auto">
    &copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.
  </footer>

</body>
</html>
