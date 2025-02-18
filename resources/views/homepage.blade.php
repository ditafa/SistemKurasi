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
        // Function to filter products based on status selection
        function filterStatus() {
            const statusFilter = document.getElementById('status-filter').value;
            const productItems = document.querySelectorAll('.product-item');

            productItems.forEach(item => {
                const productStatus = item.getAttribute('data-status');
                if (statusFilter === 'Status' || productStatus === statusFilter) {
                    item.style.display = 'grid'; // Show product
                } else {
                    item.style.display = 'none'; // Hide product
                }
            });
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-400 text-white py-4 px-4">
        <div class="max-w-6xl mx-auto">
            <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" alt="Kemeja Wanita" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
            <h1 class="text-xl font-semibold text-center mb-1">Daftar Produk</h1>
            <p class="text-sm text-center text-white/90 leading-tight px-4">
                Admin dapat meninjau setiap produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4">
        <div class="max-w-6xl mx-auto my-4">
            <!-- Search and Filter -->
            <div class="flex flex-col md:flex-row gap-3 mb-4 px-4">
                <div class="relative flex-grow">
                    <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <div class="w-full md:w-32">
                    <select id="status-filter" onchange="filterStatus()" class="w-full px-4 py-2 border border-gray-300 rounded-md appearance-none bg-white">
                        <option>Status</option>
                        <option>Diterima</option>
                        <option>Ditolak</option>
                        <option>Revisi</option>
                    </select>
                </div>
                <div class="w-full md:w-32">
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md appearance-none bg-white">
                        <option>Kategori</option>
                        <option>Fashion Wanita</option>
                        <option>Fashion Pria</option>
                        <option>Sepatu Wanita</option>
                        <option>Sepatu Pria</option>
                        <option>Aksesoris</option>
                    </select>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-5 py-3 px-4 text-sm font-medium text-blue-500">
                    <div class="pl-3">Produk</div>
                    <div>Kategori</div>
                    <div>Harga</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>

                @foreach($products as $product)
                    <div class="product-item grid grid-cols-5 items-center py-3 px-4" data-status="{{ $product->status }}">
                        <div class="flex items-center gap-3">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">Variasi</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="px-2 py-0.5 text-xs bg-gray-200 rounded-full">
                                        {{ $product->category ? $product->category->name : 'Tanpa Kategori' }}
                                    </span>
                                    <span class="px-2 py-0.5 text-xs bg-gray-200 rounded-full">
                                        {{ $product->variation ? $product->variation->name : 'Tanpa Variasi' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $product->category ? $product->category->name : 'Tanpa Kategori' }}
                        </div>
                        <div class="text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div>
                            <span class="bg-{{ $product->status == 'Diterima' ? 'green' : ($product->status == 'Ditolak' ? 'red' : 'yellow') }}-100 text-{{ $product->status == 'Diterima' ? 'green' : ($product->status == 'Ditolak' ? 'red' : 'yellow') }}-600 px-3 py-1 rounded-full text-xs">
                                {{ $product->status }}
                            </span>
                        </div>
                        <div>
                            <a href="{{ url('/detail/' . $product->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-4 gap-1">
                <!-- Add pagination here -->
                <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md bg-blue-500 text-white">1</button>
                <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md">2</button>
                <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md">3</button>
                <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md">4</button>
                <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md">5</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-400 text-white py-3 mt-auto">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <p class="text-sm font-bold">LOGO</p>
            <div class="flex items-center gap-3">
                <a href="#" class="text-white text-sm hover:text-blue-100"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white text-sm hover:text-blue-100"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white text-sm hover:text-blue-100"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
