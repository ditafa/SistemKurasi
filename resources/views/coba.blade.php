<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-400 text-white py-4 px-4">
        <div class="max-w-6xl mx-auto">
            <p class="text-xs font-bold mb-2">LOGO</p>
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
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md appearance-none bg-white">
                        <option>Status</option>
                        <option>Diterima</option>
                        <option>Ditolak</option>
                        <option>Revisi</option>
                    </select>
                </div>
            </div>
            
            <!-- Products Table -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-4 py-3 px-4 text-sm font-medium text-blue-500">
                    <div class="pl-3">Produk</div>
                    <div>Harga</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>
                
                <!-- Product Items -->
                <div class="divide-y divide-gray-200">
                    <!-- Kemeja Wanita -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Kemeja Wanita" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Kemeja Wanita</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Putih</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Katun</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">XL</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 280.000</div>
                        <div><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">Diterima</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Pashmina Premium -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Pashmina Premium" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Pashmina Premium</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Premium</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Cotton</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 599.000</div>
                        <div><span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">Ditolak</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Rok Coklat -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Rok Coklat" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Rok Coklat</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Coklat</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 559.000</div>
                        <div><span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs">Revisi</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Kemeja Pria -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Kemeja Pria" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Kemeja Pria</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Hitam</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Katun</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Tebal</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 499.000</div>
                        <div><span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs">Revisi</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Celana Pria -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Celana Pria" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Celana Pria</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Hitam</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">XL</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Tebal</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 599.000</div>
                        <div><span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">Diajukan</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Sandal -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Sandal" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Sandal</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Hitam</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 199.000</div>
                        <div><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">Diterima</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Sepatu -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Sepatu" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Sepatu</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Hitam</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Abu</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">42cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 199.000</div>
                        <div><span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">Ditolak</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                    
                    <!-- Heels -->
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="/api/placeholder/80/80" alt="Heels" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">Heels</p>
                                <p class="text-xs text-gray-500">Vettel</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Hitam</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Abu</span>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">42cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. 649.000</div>
                        <div><span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">Diajukan</span></div>
                        <div><button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button></div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center mt-6 gap-1">
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100"><i class="fas fa-chevron-left text-xs text-gray-500"></i></a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-blue-500 rounded bg-blue-500 text-white font-medium">1</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">2</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">3</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">4</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">5</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">6</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">7</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">8</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100 text-gray-600">9</a>
                <a href="#" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded bg-white hover:bg-gray-100"><i class="fas fa-chevron-right text-xs text-gray-500"></i></a>
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