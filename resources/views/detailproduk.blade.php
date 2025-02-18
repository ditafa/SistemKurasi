<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->name ?? 'Produk' }}</title>
    <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-400 text-white py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <p class="text-xs font-bold mb-2">LOGO</p>
            <h1 class="text-2xl font-semibold text-center mb-1">Detail Produk</h1>
            <p class="text-sm text-center text-white/90 leading-tight px-4">
                Admin dapat melakukan kurasi produk di sini.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4">
        <div class="max-w-6xl mx-auto my-4">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ url('/') }}" class="inline-flex items-center text-gray-600 hover:text-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Produk
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mb-6 gap-2">
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">Terima</button>
                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">Revisi</button>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">Tolak</button>
            </div>

            <!-- Product Detail -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Product Images -->
                    <div class="col-span-1">
                        <div class="border rounded-md p-2 mb-4">
                            <div class="relative pb-[100%]">
                                <img src="{{ $product->image_url ?? '' }}" 
                                     alt="{{ $product->name ?? 'Product Image' }}" 
                                     class="absolute inset-0 w-full h-full object-contain">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="border rounded-md p-1 cursor-pointer hover:border-blue-500">
                                <img src="{{ $product->image_url ?? 'https://cdn3d.iconscout.com/3d/premium/thumb/product-3d-icon-download-in-png-blend-fbx-gltf-file-formats--tag-packages-box-marketing-advertisement-pack-branding-icons-4863042.png?f=webp' }}" 
                                     alt="Product thumbnail" 
                                     class="w-full h-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="col-span-2">
                        <h1 class="text-3xl font-medium text-blue-500 mb-4">{{ $product->name ?? 'Nama Produk' }}</h1>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-medium">Kategori:</span> 
                                <span class="text-blue-500">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                            </p>
                            <p class="text-sm text-gray-700 mb-6">
                                {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                            </p>
                        </div>

                        <!-- Colors and Sizes -->
                        @if(isset($product->variation) && $product->variation)
                            <div class="mb-6">
                                @if(isset($product->variation->colors) && is_array($product->variation->colors))
                                    <p class="text-sm font-medium mb-2">Warna:</p>
                                    <div class="flex gap-2 mb-4">
                                        @foreach($product->variation->colors as $color)
                                            <span class="border px-3 py-1 rounded-full text-xs {{ $loop->first ? 'bg-blue-100 border-blue-500 text-blue-500' : '' }}">
                                                {{ $color }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($product->variation->sizes) && is_array($product->variation->sizes))
                                    <p class="text-sm font-medium mb-2">Ukuran:</p>
                                    <div class="flex gap-2">
                                        @foreach($product->variation->sizes as $size)
                                            <span class="border w-8 h-8 flex items-center justify-center rounded-full text-xs {{ $loop->first ? 'bg-blue-100 border-blue-500 text-blue-500' : '' }}">
                                                {{ $size }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Price -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                            </h2>
                        </div>

                        <!-- Timeline -->
                        <div>
                            <h3 class="text-lg font-medium mb-4">Timeline Status:</h3>
                            <div class="relative">
                                <!-- Timeline Line -->
                                <div class="absolute h-full w-px bg-gray-300 left-4"></div>
                                
                                <!-- Timeline Events -->
                                <div class="ml-8 space-y-8">
                                    <!-- Default status if no history -->
                                    <div class="relative">
                                        <div class="absolute -left-8 mt-1.5">
                                            <div class="w-4 h-4 rounded-full bg-blue-500 border-4 border-white"></div>
                                        </div>
                                        <div>
                                            <h4 class="text-base font-semibold text-blue-600">
                                                {{ $product->status ?? 'Diajukan' }}
                                            </h4>
                                            <p class="text-sm text-gray-500">Status produk saat ini</p>
                                            <p class="text-xs text-gray-400">
                                                Tanggal: {{ $product->created_at ? $product->created_at->format('d F Y H:i') : now()->format('d F Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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