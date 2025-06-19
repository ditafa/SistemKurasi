<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Produk - Kurasi Bantul</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8FFF9] text-gray-700 font-sans flex min-h-screen">
  <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-40">
    <div>
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
    <h1 class="text-3xl font-bold text-[#388e3c] mb-4">Detail Produk</h1>

    <div>
      <div class="border p-2 rounded-lg mb-4">
        @if ($product->photos && $product->photos->isNotEmpty())
          <img src="{{ asset('storage/' . $product->photos->first()->path) }}" class="w-full rounded-lg" alt="Foto Produk Utama">
        @else
          <img src="{{ asset('img/placeholder.jpg') }}" class="w-full rounded-lg" alt="Tidak ada foto">
        @endif
      </div>

    <!-- Detail Produk -->
    <div>
      <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
      <p class="text-sm text-gray-500 mb-4">Kategori: <span class="font-medium">{{ $product->category->name }}</span></p>

      <p class="text-gray-700 mb-4">{{ $product->description }}</p>

      @if($product->type === 'variation')
        <p class="mb-2"><span class="font-semibold">Warna:</span> {{ implode(', ', $product->color ?? []) }}</p>
        <p class="mb-2"><span class="font-semibold">Ukuran:</span> {{ implode(', ', $product->size ?? []) }}</p>
      @endif

      <p class="text-xl font-semibold text-gray-800 mt-4 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

      <!-- Status Kurasi -->
      <div class="mb-6">
        <p class="text-sm text-gray-500 mb-2">Status Kurasi:</p>
        <span class="@if($product->status === 'Diterima') bg-green-100 text-green-700 
                      @elseif($product->status === 'Revisi') bg-yellow-100 text-yellow-700 
                      @else bg-red-100 text-red-700 
                      @endif px-3 py-1 rounded-full text-sm font-medium">
          {{ $product->status }}
        </span>
      </div>

      <!-- Timeline -->
      <div class="mt-8">
        <h4 class="font-semibold mb-2">Timeline Status :</h4>
        @if($product->productStatusHistories && !$product->productStatusHistories->isEmpty())
          <ul class="text-sm space-y-2">
            @foreach ($product->productStatusHistories as $history)
              <li>
                @if ($history->status === 'diajukan')
                  Produk diajukan oleh ID Pedagang {{ $product->pedagang_id }} <br>
                @elseif ($history->status === 'diterima')
                  Produk disetujui oleh ID Admin {{ $history->admin_id ?? '-' }} <br>
                @elseif ($history->status === 'ditolak')
                  Produk ditolak oleh ID Admin {{ $history->admin_id ?? '-' }} <br>
                @elseif ($history->status === 'revisi')
                  Produk dikembalikan untuk revisi oleh ID Admin {{ $history->admin_id ?? '-' }} <br>
                @else
                  Status: {{ ucfirst($history->status) }} <br>
                @endif
                Tanggal: {{ \Carbon\Carbon::parse($history->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB
              </li>
            @endforeach
          </ul>
        @else
          <p class="text-sm text-gray-500">Tidak ada timeline kurasi untuk produk ini.</p>
        @endif
      </div>

      <a href="{{ route('pedagang.produk.index') }}" class="inline-block mt-8 text-blue-600 hover:underline">← Kembali ke Daftar Produk</a>
    </div>
  </div>
</body>
</html>
