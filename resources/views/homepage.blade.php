<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurasi Produk Bantul</title>
    <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        function filterProducts() {
            const form = document.getElementById('filter-form');
            form.submit();
        }

        function handleSearch(event) {
            if (event.key === 'Enter') {
                const form = document.getElementById('filter-form');
                form.submit();
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col m-0">
    <!-- Header -->
    <header class="bg-[#678FAA] text-white py-4 px-6 w-full">
        <div class="w-full mx-auto">
            <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul">
            <h1 class="text-xl font-semibold text-center mb-1">Daftar Produk</h1>
            <p class="text-sm text-center text-white/90 leading-tight px-4">
                Admin dapat meninjau setiap produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4">
        <div class="w-full mx-auto my-4">
            <!-- Search and Filter -->
            <form id="filter-form" action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 mb-4 px-4">
                <div class="relative flex-grow">
                    <input type="text" 
                        name="search" 
                        placeholder="Cari produk..." 
                        value="{{ request('search') }}"
                        onkeypress="handleSearch(event)"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <div class="relative w-full md:w-32">
                <select name="status" onchange="filterProducts(this)" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10">
                    <option value="" disabled selected hidden>Status</option>
                    <option value="{{ url('/') }}">Semua</option> <!-- Arahkan ke halaman utama -->
                    @foreach($statuses as $status)
                        <option value="{{ request()->fullUrlWithQuery(['status' => $status]) }}" 
                            {{ request('status') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

                <script>
                    function filterProducts(select) {
                        var selectedValue = select.value;
                        if (selectedValue) {
                            window.location.href = selectedValue; // Redirect ke URL yang dipilih
                        }
                    }
                </script>
                    <img src="{{ 'https://uxwing.com/wp-content/themes/uxwing/download/arrow-direction/arrow-down-icon.png' }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none" alt="Dropdown Icon">
                </div>

                <div class="relative w-full md:w-32">
                    <select name="category" onchange="filterCategory(this)" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10">
                        <option value="{{ url('/') }}">Semua</option> <!-- Kembali ke halaman utama -->
                        @foreach($categories as $category)
                            <option value="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <img src="https://uxwing.com/wp-content/themes/uxwing/download/arrow-direction/arrow-down-icon.png" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none" alt="Dropdown Icon">
                </div>

                <script>
                    function filterCategory(select) {
                        var selectedValue = select.value;
                        if (selectedValue) {
                            window.location.href = selectedValue; // Redirect ke URL filter
                        }
                    }
                </script>

            </form>

            <!-- Products Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:shadow-xl">
                <!-- Header with border -->
                <div class="grid grid-cols-5 py-4 px-6 text-sm font-semibold text-gray-600 border-b border-gray-100 bg-gray-50 text-center">
                    <div class="pl-3">Produk</div>
                    <div>Kategori</div>
                    <div>Harga</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>

                @foreach($products as $product)
                    <div class="product-item grid grid-cols-5 items-center py-4 px-6 border-b border-gray-100 hover:bg-gray-50 transition-colors text-center">
                        <div class="flex items-center gap-4">
                            @if($product->first_photo)
                                <img src="{{ $product->first_photo->url }}" alt="{{ $product->name }}" 
                                    class="w-16 h-16 object-cover bg-gray-100 rounded-lg shadow-sm">
                            @endif
                            <div>
                                <p class="text-blue-600 font-medium mb-1">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500 text-left">Variasi :</p>
                                <div class="flex flex-wrap gap-2">
                                    @if($product->category)
                                        <span class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-full">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                    @if($product->variations->isNotEmpty())
                                        <span class="px-3 py-1 text-xs bg-purple-100 text-purple-600 rounded-full">
                                            {{ $product->variations->first()->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">
                        <div class="text-sm text-gray-600">
                        {{ $product->rootCategory ? $product->rootCategory->name : 'Tanpa Kategori' }}
                    </div>

                        </div>
                        <div class="text-sm font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div>
                            <span class="{{ $product->statusColor['bg'] }} {{ $product->statusColor['text'] }} 
                                        inline-flex items-center justify-center 
                                        px-3 py-1 rounded-full text-xs font-medium 
                                        min-w-[100px] min-h-[24px] text-center">
                                {{ $product->formatted_status }}
                            </span>
                        </div>


                        <div>
                            <a href="{{ route('products.show', $product->id) }}" 
                                class="inline-flex items-center gap-2 bg-[#678FAA] hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
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
                    <button disabled class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-gray-100">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if ($page == $products->currentPage())
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md bg-blue-500 text-white">
                            {{ $page }}
                        </button>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-blue-50">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </a>
                @else
                    <button disabled class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-gray-100">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                @endif
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r bg-[#678FAA] text-white py-4 mt-8 w-full">
        <div class="w-full mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm font-medium">
                © 2025 Pemkab Bantul. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="https://www.instagram.com/diskominfobantul/" class="text-white hover:text-blue-100 transition-colors">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="https://x.com/kominfobantul" class="text-white hover:text-blue-100 transition-colors">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="https://www.facebook.com/kominfobantul/" class="text-white hover:text-blue-100 transition-colors">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
                <a href="https://www.youtube.com/c/BantulTV" class="text-white hover:text-blue-100 transition-colors">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
