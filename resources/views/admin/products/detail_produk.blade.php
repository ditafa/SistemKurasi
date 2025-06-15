<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8FFF9] text-gray-700 font-sans flex">

  <!-- Sidebar -->
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10">
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

  <!-- Main Content -->
  <main class="flex-1 ml-0 md:ml-64 p-6 max-w-3xl mx-auto">
    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <h1 class="text-3xl font-bold mb-6">Detail Produk</h1>

    <div class="space-y-2">
      <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
      <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
      <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
      <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
      <p><strong>Status Saat Ini:</strong> <span class="font-semibold capitalize">{{ $product->status }}</span></p>
    </div>

    <form action="{{ route('admin.products.kurasi', $product->id) }}" method="POST" class="mt-6">
      @csrf
      <label for="statusSelect" class="block mb-2 font-semibold">Ubah Status:</label>
      <select id="statusSelect" name="kurasi_status" class="w-full border rounded p-2 mb-4">
        <option value="diterima" {{ old('kurasi_status') === 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="ditolak" {{ old('kurasi_status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        <option value="diterima dengan revisi" {{ old('kurasi_status') === 'diterima dengan revisi' ? 'selected' : '' }}>Revisi</option>
      </select>

      <div id="notesContainer" class="{{ old('kurasi_status') === 'diterima dengan revisi' ? '' : 'hidden' }} mb-4">
        <label for="notes" class="block mb-2 font-semibold">Catatan Revisi:</label>
        <textarea id="notes" name="kurasi_notes" class="w-full border rounded p-2" rows="3">{{ old('kurasi_notes') }}</textarea>
      </div>

      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Simpan Kurasi
      </button>
    </form>

    <a href="{{ route('admin.products.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">
      &larr; Kembali ke Daftar Produk
    </a>
  </main>

  <script>
    const statusSelect = document.getElementById('statusSelect');
    const notesContainer = document.getElementById('notesContainer');
    const notesTextarea = document.getElementById('notes');

    function toggleNotes() {
      const status = statusSelect.value.toLowerCase();
      if (status === 'diterima dengan revisi') {
        notesContainer.classList.remove('hidden');
      } else {
        notesContainer.classList.add('hidden');
        notesTextarea.value = '';
      }
    }

    // Inisialisasi saat halaman pertama kali dibuka
    toggleNotes();

    // Event saat user ganti opsi
    statusSelect.addEventListener('change', toggleNotes);
  </script>

</body>
</html>
