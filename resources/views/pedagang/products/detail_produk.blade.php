<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk - Kurasi Bantul</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8FFF9] text-gray-700 font-sans flex min-h-screen">

  <!-- Sidebar (desktop) -->
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-40">
    <div>
      <!-- Logo -->
      <div class="flex items-center justify-between mb-10">
        <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12" />
      </div>

      <!-- Navigasi -->
      <nav class="flex flex-col space-y-4 text-sm font-medium">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <hr class="border-white/40 my-6" />
        <div class="space-y-3">
          <a href="{{ route('pedagang.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
          <a href="{{ route('pedagang.produk.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
          <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
          <a href="{{ route('pedagang.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Notifikasi</a>
          <a href="{{ route('pedagang.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Statistik</a>
          <form action="{{ route('pedagang.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
          </form>
        </div>
      </nav>
    </div>
  </aside>

  <div class="flex-1 ml-64 p-10">
    <!-- Heading -->
    <h1 class="text-3xl font-bold text-[#388e3c] mb-4">Detail Produk</h1>

    <!-- Produk Detail -->
    <div class="bg-white p-6 rounded-xl shadow-md">
      <div class="flex gap-6">
        <!-- Gambar Produk -->
        <div>
          @if($product->firstPhoto)
            <img src="{{ asset('storage/' . $product->firstPhoto->filepath) }}" alt="{{ $product->name }}" class="w-64 h-64 object-cover rounded-lg" />
          @else
            <div class="w-64 h-64 bg-gray-200 flex items-center justify-center text-gray-400 text-xs rounded-lg">No Image</div>
          @endif
        </div>

        <!-- Info Produk -->
        <div class="flex-1">
          <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>

          <p class="text-gray-600">Kategori: <span class="font-semibold">{{ $product->category->name ?? 'Tidak ada kategori' }}</span></p>

          <p class="text-gray-600">Harga: <span class="font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span></p>

          <p class="text-gray-600">Status: <span class="font-semibold">{{ ucfirst($product->status) }}</span></p>

          <p class="mt-4 text-gray-700">{{ $product->description }}</p>
        </div>
      </div>
    </div>

    <!-- Timeline Kurasi -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
      <h3 class="text-xl font-semibold text-[#388e3c] mb-4">Timeline Kurasi</h3>
      
      @if($product->curationTimeline && $product->curationTimeline->count() > 0)
        <ul class="space-y-4">
          @foreach ($product->curationTimeline as $timeline)
            <li class="flex items-center space-x-3">
              <div class="w-3 h-3 bg-green-600 rounded-full"></div>
              <div>
                <p class="text-sm font-semibold">{{ $timeline->status }}</p>
                <p class="text-gray-500 text-xs">{{ $timeline->created_at->format('d M Y H:i') }}</p>
                <p class="text-gray-600 text-sm">{{ $timeline->description }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p class="text-gray-600">Tidak ada timeline kurasi untuk produk ini.</p>
      @endif
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('pedagang.dataproduk') }}" class="mt-6 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
      Kembali ke Daftar Produk
    </a>
  </div>

</body>

</html>
