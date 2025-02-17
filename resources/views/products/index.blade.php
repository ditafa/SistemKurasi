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

    <header class="bg-blue-400 text-white py-4 px-4">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-xl font-semibold text-center">Daftar Produk</h1>
            <p class="text-sm text-center text-white/90">Admin dapat meninjau setiap produk yang diajukan.</p>
        </div>
    </header>
    
    <main class="flex-grow p-4">
        <div class="max-w-6xl mx-auto">
            
            <!-- Search and Filter -->
            <div class="flex flex-col md:flex-row gap-3 mb-4 px-4">
                <div class="relative flex-grow">
                    <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <div class="w-full md:w-32">
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-md">
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

                <!-- Loop Data dari Database -->
                <div class="divide-y divide-gray-200">
                    @foreach($products as $product)
                    <div class="grid grid-cols-4 items-center py-3 px-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover bg-gray-100 rounded-md">
                            <div>
                                <p class="text-blue-600 font-medium">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">{{ $product->brand }}</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach(json_decode($product->attributes) as $attr)
                                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">{{ $attr }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div>
                            @if($product->status == 'Diterima')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">{{ $product->status }}</span>
                            @elseif($product->status == 'Ditolak')
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">{{ $product->status }}</span>
                            @elseif($product->status == 'Revisi')
                                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs">{{ $product->status }}</span>
                            @else
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">{{ $product->status }}</span>
                            @endif
                        </div>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Lihat Detail</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

</body>
</html>
