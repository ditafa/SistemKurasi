<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->name ?? 'Produk' }}</title>
    <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-[#678FAA] text-white py-4 px-6 w-full">
        <div class="w-full mx-auto">
            <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul">
            <h1 class="text-xl font-semibold text-center mb-1">Detail Produk</h1>
            <p class="text-sm text-center text-white/90 leading-tight px-4">
                Admin dapat mengkurasi produk.
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

            <!-- Product Detail -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Product Images -->
                    <div class="col-span-1" x-data="{ mainImage: '{{ $product->first_photo->url }}' }">
                    <!-- Gambar Utama Produk -->
                    <div class="border rounded-md p-2 mb-4">
                        <div class="relative pb-[100%]">
                            <img :src="mainImage" 
                                alt="{{ $product->name ?? 'Product Image' }}" 
                                class="absolute inset-0 w-full h-full object-contain">
                        </div>
                    </div>

                    <!-- Variasi Gambar -->
                    <div class="grid grid-cols-4 gap-2">
                        @if($product->photos && $product->photos->count() > 0)
                            @foreach($product->photos as $photo)
                                <div class="relative pb-[100%]">
                                    <img src="{{ $photo->url }}" 
                                        alt="{{ $product->name }}" 
                                        @click="mainImage = '{{ $photo->url }}'"
                                        class="absolute inset-0 w-full h-full object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity">
                                </div>
                            @endforeach
                        @else
                            <p class="col-span-4 text-gray-500 text-sm">Gambar variasi tidak tersedia.</p>
                        @endif
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
                            <div>
                                <p class="text-sm text-gray-600 mb-1">
                                    <span class="font-medium">Variasi Produk:</span>
                                </p>
                                <div class="space-x-2">
                                    @forelse ($product->variations as $variation)
                                        <span class="inline-block bg-blue-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $variation->name }}
                                        </span>
                                    @empty
                                        <span class="inline-block bg-gray-300 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                                            Tidak ada variasi
                                        </span>
                                    @endforelse
                                </div>
                            </div>
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
                        <h3 class="text-lg font-medium mb-4">Pilih Status:</h3>
                        <!-- Action Buttons (Pindah ke bawah harga) -->
                        <div class="mb-6" x-data="{ 
                            showRevisionModal: false, 
                            revisionNote: '',
                            showConfirmModal: false,
                            confirmationType: '',
                            confirmationMessage: '',
                            onConfirm: () => {}
                        }">
                            <!-- Confirm Modal -->
                            <div 
                                x-show="showConfirmModal" 
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0">
                                
                                <div 
                                    @click.away="showConfirmModal = false"
                                    class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-xl"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="transform scale-95 opacity-0"
                                    x-transition:enter-end="transform scale-100 opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="transform scale-100 opacity-100"
                                    x-transition:leave-end="transform scale-95 opacity-0">
                                    
                                    <div class="text-center">
                                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full" 
                                            :class="{
                                                'bg-green-100': confirmationType === 'accept',
                                                'bg-yellow-100': confirmationType === 'revision',
                                                'bg-red-100': confirmationType === 'reject'
                                            }">
                                            <i class="fas" 
                                            :class="{
                                                    'fa-check text-green-600': confirmationType === 'accept',
                                                    'fa-edit text-yellow-600': confirmationType === 'revision',
                                                    'fa-times text-red-600': confirmationType === 'reject'
                                            }"></i>
                                        </div>
                                        
                                        <h3 class="mt-4 text-lg font-medium text-gray-900" x-text="confirmationMessage"></h3>
                                        
                                        <div class="mt-6 flex justify-center gap-3">
                                            <button 
                                                @click="showConfirmModal = false" 
                                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Tidak
                                            </button>
                                            <button 
                                                @click="onConfirm(); showConfirmModal = false"
                                                :class="{
                                                    'bg-green-600 hover:bg-green-700': confirmationType === 'accept',
                                                    'bg-yellow-500 hover:bg-yellow-600': confirmationType === 'revision',
                                                    'bg-red-600 hover:bg-red-700': confirmationType === 'reject'
                                                }"
                                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Ya
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2">
                                <button 
                                    @click="
                                        confirmationType = 'accept';
                                        confirmationMessage = 'Apakah Anda yakin ingin menerima produk ini?';
                                        onConfirm = () => {
                                            // Add your logic here for accepting the product
                                            console.log('Product accepted');
                                        };
                                        showConfirmModal = true;
                                    "
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Terima
                                </button>
                                
                                <button 
                                    @click="showRevisionModal = true"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Diterima Dengan Revisi
                                </button>
                                
                                <button 
                                    @click="
                                        confirmationType = 'reject';
                                        confirmationMessage = 'Apakah Anda yakin ingin menolak produk ini?';
                                        onConfirm = () => {
                                            // Add your logic here for rejecting the product
                                            console.log('Product rejected');
                                        };
                                        showConfirmModal = true;
                                    "
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Tolak
                                </button>
                            </div>

                            <!-- Revision Modal -->
                            <div 
                                x-show="showRevisionModal" 
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div 
                                    @click.away="showRevisionModal = false"
                                    class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                                    
                                    <h3 class="text-lg font-semibold mb-4">Catatan Revisi</h3>
                                    
                                    <textarea 
                                        x-model="revisionNote"
                                        class="w-full h-32 p-2 border rounded-md mb-4 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        placeholder="Tulis catatan revisi di sini..."></textarea>
                                    
                                    <div class="flex justify-end gap-2">
                                        <button 
                                            @click="showRevisionModal = false" 
                                            class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 rounded-md">
                                            Batal
                                        </button>
                                        <button 
                                            @click="if(revisionNote.trim()) { 
                                                showRevisionModal = false;
                                                confirmationType = 'revision';
                                                confirmationMessage = 'Apakah Anda yakin ingin mengirim revisi ini?';
                                                onConfirm = () => {
                                                    // Add your logic here for revision
                                                    console.log('Revision note:', revisionNote);
                                                    revisionNote = '';
                                                };
                                                showConfirmModal = true;
                                            }"
                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 rounded-md">
                                            Simpan Revisi
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                                {{ 'Diajukan' }}
                                            </h4>
                                            <p class="text-sm text-gray-500">{{'Belum ada catatan' }}</p>

                                            <p class="text-xs text-gray-400">
                                                Tanggal: {{ $product->created_at ? $product->created_at->format('d F Y H:i') : now()->format('d F Y H:i') }}
                                            </p>
                                        </div>
                                        @if ($product)
                                            @php
                                                // Tentukan warna berdasarkan status produk
                                                $statusColor = match($product->formatted_status) {
                                                    'Diterima' => 'green',
                                                    'Ditolak' => 'red',
                                                    'Diterima dengan Revisi', 'Revisi' => 'yellow',
                                                    default => 'blue'
                                                };
                                            @endphp

                                            <div class="absolute -left-8 mt-1.5">
                                                <div class="w-4 h-4 rounded-full bg-{{ $statusColor }}-500 border-4 border-white"></div>
                                            </div>
                                            <div>
                                                <h4 class="text-base font-semibold text-{{ $statusColor }}-600">
                                                    {{ $product->formatted_status ?? 'Status Tidak Tersedia' }}
                                                </h4>

                                                {{-- Tampilkan Catatan Revisi hanya jika statusnya "Revisi" atau "Diterima dengan Revisi" --}}
                                                @if (in_array($product->formatted_status, ['Revisi', 'Diterima dengan Revisi']))
                                                    <p class="text-sm text-gray-500">Catatan Revisi:</p>
                                                @endif
                                                <p class="text-sm text-gray-500">{{ $product->latestHistory->notes ?? 'Belum ada catatan' }}</p>

                                                <p class="text-xs text-gray-400">
                                                    Tanggal: {{ optional($product->created_at)->format('d F Y H:i') ?? now()->format('d F Y H:i') }}
                                                </p>
                                            </div>
                                        @else
                                            <p class="text-sm text-red-500">Produk tidak ditemukan.</p>
                                        @endif

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
