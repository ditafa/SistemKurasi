<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Notifikasi Pedagang - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

  <!-- Sidebar -->
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6">
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
          <a href="{{ route('pedagang.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
          <a href="{{ route('pedagang.produk.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
          <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
          <a href="{{ route('pedagang.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition font-bold bg-white/20 rounded-lg">
            Notifikasi
            @if($jumlahBelumDibaca > 0)
              <span class="ml-1 inline-block bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                {{ $jumlahBelumDibaca }}
              </span>
            @endif
          </a>
          <a href="{{ route('pedagang.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
          <form action="{{ route('pedagang.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
          </form>
        </div>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6 md:ml-64 flex flex-col items-center justify-start min-h-screen">
    <header class="max-w-4xl mb-8 text-center w-full">
      <h1 class="text-4xl font-extrabold text-[#4a8a4a] leading-tight mb-2">NOTIFIKASI</h1>
      <p class="text-sm text-gray-600 max-w-lg mx-auto">
        Halaman ini menampilkan seluruh notifikasi terkait pengajuan produk Anda.
      </p>
    </header>

    <section class="max-w-4xl w-full space-y-4">
      {{-- Notifikasi flash --}}
      @if(session('success'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-xl shadow max-w-md mx-auto">
          <h2 class="text-lg font-semibold text-blue-700">Notifikasi Baru</h2>
          <p>{{ session('success') }}</p>
          <span class="text-xs text-gray-500 block mt-1">Baru saja</span>
        </div>
      @endif

      {{-- Loop notifikasi --}}
      @forelse ($notifikasis as $notif)
        <div class="p-4 rounded-xl shadow border transition @if(!$notif->is_read) bg-yellow-50 border-yellow-300 @else bg-white border-green-100 @endif">
          <h2 class="text-lg font-semibold text-[#14532D]">{{ $notif->title }}</h2>
          <p class="text-gray-700 mt-1">{{ $notif->message }}</p>
          <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
            <span>{{ $notif->created_at->diffForHumans() }}</span>
            @if(!$notif->is_read)
              <form method="POST" action="{{ route('pedagang.notifikasi.baca', $notif->id) }}">
                @csrf
                <button class="text-green-600 hover:underline">Tandai dibaca</button>
              </form>
            @endif
          </div>
        </div>
      @empty
        <div class="text-center bg-white p-6 rounded-xl shadow text-gray-500">
          Tidak ada notifikasi saat ini.
        </div>
      @endforelse
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-[#14532D] text-white text-sm py-6 text-center mt-auto">
    <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
  </footer>

</body>
</html>
