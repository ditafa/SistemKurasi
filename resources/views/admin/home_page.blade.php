<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Produk Kurasi - Dashboard Kurasi Bantul</title>
  <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#dff5e3] text-[#555555]">

  <!-- Navbar -->
  <nav class="bg-[#2ecc71] flex items-center justify-between px-6 py-4 shadow-md">
    <div class="flex items-center space-x-3">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul" class="h-12">
    </div>
    <div class="hidden md:flex space-x-8 items-center text-white font-semibold">
      <a href="/" class="hover:text-gray-200">Beranda</a>
      <a href="/about" class="hover:text-gray-200">Tentang Kami</a>
      <a href="/kontak" class="hover:text-gray-200">Kontak</a>
      <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center text-white font-semibold hover:text-gray-200">
          Masuk
          <svg class="ml-1 w-4 h-4 fill-current" viewBox="0 0 20 20">
            <path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.06l3.71-3.83a.75.75 0 0 1 1.08 1.04l-4.25 4.39a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06z"/>
          </svg>
        </button>
        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-10 text-black">
          <a href="/login-admin" class="block px-4 py-2 hover:bg-gray-100">Admin</a>
          <a href="/login-pedagang" class="block px-4 py-2 hover:bg-gray-100">Pedagang</a>
        </div>
      </div>
    </div>
  </nav>
    <!-- Main Content -->
    <main class="flex-grow p-4">
        <h1 class="text-xl font-semibold text-center mb-1">Daftar Produk</h1>
        <p class="text-sm text-center text-black/90 leading-tight px-4">
            Admin dapat meninjau setiap produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
        </p>

        <div class="w-full mx-auto my-4">
            <!-- Search and Filter -->
            <form
                id="filter-form"
                action="{{ route('products.index') }}"
                method="GET"
                class="flex flex-col md:flex-row gap-3 mb-4 px-4"
            >
                <!-- Search Field -->
                <div class="relative flex-grow">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari produk..."
                        value="{{ request('search') }}"
                        onkeypress="handleSearch(event)"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md"
                    />
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"
                    >
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <!-- Status Field -->
                <div class="relative w-full md:w-32">
                    <select
                        name="status"
                        onchange="window.location.href=this.value"
                        class="w-full h-[42px] px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10"
                    >
                        <option value="" disabled {{ !request('status') ? 'selected' : '' }} hidden>Status</option>
                        <option value="{{ request()->url() }}" {{ request('status') === null ? 'selected' : '' }}>
                            Semua
                        </option>
                        @foreach ($statuses as $status)
                        <option
                            value="{{ request()->fullUrlWithQuery(['status' => strtolower($status)]) }}"
                            {{ strtolower(request('status')) === strtolower($status) ? 'selected' : '' }}
                        >
                            {{ $status }}
                        </option>
                        @endforeach
                    </select>
                    <img
                        src="{{ asset('images/down-arrow.png') }}"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none"
                        alt="Dropdown Icon"
                    />
                </div>

                <!-- Category Field -->
                <div class="relative w-full md:w-80">
                    <select
                        id="category-select"
                        name="category"
                        onchange="filterCategory(this)"
                        class="w-full h-[42px] px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10"
                    >
                        <option value="" disabled selected hidden>Pilih Kategori</option>
                        <option value="{{ url('/') }}">Semua Kategori</option>

                        @foreach ($categories as $category)
                        <option
                            value="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                        @if ($category->children->isNotEmpty())
                        @foreach ($category->children as $child)
                        <option
                            value="{{ request()->fullUrlWithQuery(['category' => $child->id]) }}"
                            {{ request('category') == $child->id ? 'selected' : '' }}
                            class="text-gray-700"
                        >
                            {{ $category->name }} &gt; {{ $child->name }}
                        </option>

                        @if ($child->children->isNotEmpty())
                        @foreach ($child->children as $subChild)
                        <option
                            value="{{ request()->fullUrlWithQuery(['category' => $subChild->id]) }}"
                            {{ request('category') == $subChild->id ? 'selected' : '' }}
                            class="text-gray-600"
                        >
                            {{ $category->name }} &gt; {{ $child->name }} &gt; {{ $subChild->name }}
                        </option>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </select>
                    <img
                        src="{{ asset('images/down-arrow.png') }}"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none"
                        alt="Dropdown Icon"
                    />
                </div>
            </form>

            <!-- Products Table -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:shadow-xl"
            >
                <!-- Table Header -->
                <div
                    class="grid grid-cols-5 py-4 px-6 text-sm font-semibold text-gray-600 border-b border-gray-100 bg-gray-50 text-center"
                >
                    <div class="pl-3">Produk</div>
                    <div>Kategori</div>
                    <div>Harga</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>

                <!-- Product Items -->
                @foreach ($products as $product)
                <div
                    class="product-item grid grid-cols-5 items-center py-4 px-6 border-b border-gray-100 hover:bg-gray-50 transition-colors text-center"
                >
                    <div class="flex items-start gap-3 text-left">
                        @if ($product->first_photo)
                        <img
                            src="{{ $product->first_photo->url }}"
                            alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover bg-gray-100 rounded-lg shadow-sm"
                        />
                        @else
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center"
                        >
                            <i class="fas fa-image text-gray-400 text-xl"></i>
                        </div>
                        @endif
                        <div>
                            <p class="text-blue-600 font-medium mb-1">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">Variasi :</p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @if ($product->variations->isNotEmpty())
                                @foreach ($product->variations as $variation)
                                <span
                                    class="px-2 py-1 text-xs bg-purple-100 text-purple-600 rounded-full"
                                >
                                    {{ $variation->name }}
                                </span>
                                @endforeach
                                @else
                                <span
                                    class="px-2 py-1 text-xs bg-gray-200 text-gray-600 rounded-full"
                                >
                                    Tidak Ada
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600">
                        {{ $product->rootCategory ? $product->rootCategory->name : 'Tanpa Kategori' }}
                    </div>

                    <div class="text-sm font-medium">
                        Rp {{ number_format($product->price, 0, ",", ".") }}
                    </div>

                    <div>
                        @php
                        $status = ucfirst($product->latestHistory->status ?? "Diajukan");
                        $statusColor = [
                            "Diterima" => ["bg" => "bg-green-500", "text" => "text-white"],
                            "Ditolak" => ["bg" => "bg-red-500", "text" => "text-white"],
                            "Diterima dengan revisi" => ["bg" => "bg-yellow-500", "text" => "text-white"],
                            "Diajukan" => ["bg" => "bg-blue-500", "text" => "text-white"],
                        ];
                        $color = $statusColor[$status] ?? ["bg" => "bg-gray-500", "text" => "text-white"];
                        @endphp

                        <span
                            class="{{ $color['bg'] }} {{ $color['text'] }} inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-medium min-w-[100px] min-h-[24px] text-center"
                        >
                            {{ $status }}
                        </span>
                    </div>

                    <div>
                        <a
                            href="{{ route('products.show', $product->id) }}"
                            class="inline-flex items-center gap-2 bg-[#678FAA] hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                        >
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            
            <!-- Pagination -->
            @if ($products->hasPages())
<div class="flex justify-center mt-4 gap-1">
    {{-- Previous Page Link --}}
    @if ($products->onFirstPage())
    <button
        disabled
        class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-gray-100"
    >
        <i class="fas fa-chevron-left text-sm"></i>
    </button>
    @else
    <a
        href="{{ $products->previousPageUrl() }}"
        class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50"
    >
        <i class="fas fa-chevron-left text-sm"></i>
    </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        @if ($page == $products->currentPage())
        <button
            class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md bg-blue-500 text-white"
            disabled
        >
            {{ $page }}
        </button>
        @else
        <a
            href="{{ $url }}"
            class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50"
        >
            {{ $page }}
        </a>
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($products->hasMorePages())
    <a
        href="{{ $products->nextPageUrl() }}"
        class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50"
    >
        <i class="fas fa-chevron-right text-sm"></i>
    </a>
    @else
    <button
        disabled
        class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-gray-100"
    >
        <i class="fas fa-chevron-right text-sm"></i>
    </button>
    @endif
</div>
@endif

<div>
<!-- Footer -->
  <footer class="bg-[#2ecc71] text-white py-6 text-center text-sm">
    <p>&copy; 2025 PemKab Bantul. All Rights Reserved.</p>
    <div class="flex justify-center space-x-4 mt-2">
      <a href="https://www.facebook.com/kominfobantul" target="_blank" aria-label="Facebook">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M22 12a10 10 0 1 0-11.6 9.87v-7h-2v-2.87h2v-2.2c0-2 1.2-3.13 3-3.13.9 0 1.8.16 1.8.16v2h-1c-1 0-1.3.64-1.3 1.3v1.9h2.3L15 15h-2v7A10 10 0 0 0 22 12z"/>
        </svg>
      </a>
      <a href="https://www.instagram.com/diskominfobantul/" target="_blank" aria-label="Instagram">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm4.75-.88a.88.88 0 1 1 0 1.76.88.88 0 0 1 0-1.76Z"/>
        </svg>
      </a>
      <a href="https://www.youtube.com/results?search_query=diskominfo+bantul" target="_blank" aria-label="YouTube">
        <svg class="w-5 h-5 fill-current hover:text-gray-300" viewBox="0 0 24 24">
          <path d="M10 15.5v-7l6 3.5-6 3.5ZM21.8 7.2c-.2-1.1-1.1-2-2.2-2.2C17.8 4.5 12 4.5 12 4.5s-5.8 0-7.6.5c-1.1.2-2 1.1-2.2 2.2C2 9 2 12 2 12s0 3 .2 4.8c.2 1.1 1.1 2 2.2 2.2 1.8.5 7.6.5 7.6.5s5.8 0 7.6-.5c1.1-.2 2-1.1 2.2-2.2.2-1.8.2-4.8.2-4.8s0-3-.2-4.8Z"/>
        </svg>
      </a>
    </div>
  </footer>
  </body>
</html>