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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <head>
    <!-- Your other head elements -->
    <script>
    // Function for Accept confirmation
    function confirmAccept() {
        Swal.fire({
            title: 'Konfirmasi Terima',
            text: "Apakah Anda yakin ingin menerima produk ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10B981',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Terima',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus('diterima');
            }
        });
    }

    // Function for Revision with Note
    async function revisionWithNote() {
        const { value: revisionText } = await Swal.fire({
            title: 'Catatan Revisi',
            input: 'textarea',
            inputLabel: 'Masukkan catatan revisi',
            inputPlaceholder: 'Tulis catatan revisi di sini...',
            inputAttributes: {
                'aria-label': 'Tulis catatan revisi di sini'
            },
            showCancelButton: true,
            confirmButtonColor: '#EAB308',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal'
        });

        if (revisionText) {
            // Show confirmation dialog
            const result = await Swal.fire({
                title: 'Konfirmasi Revisi',
                text: 'Apakah Anda yakin ingin mengirim revisi ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#EAB308',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            });

            if (result.isConfirmed) {
                updateStatus('diterima dengan revisi', revisionText);
            }
        }
    }

    // Function for Reject confirmation
    function confirmReject() {
        Swal.fire({
            title: 'Konfirmasi Tolak',
            text: "Apakah Anda yakin ingin menolak produk ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus('ditolak');
            }
        });
    }

    // Function to update status via AJAX
function updateStatus(status, notes = '') {
    // Tambahkan timestamp sekarang
    const currentTimestamp = new Date().toISOString();
    
    // Tampilkan loading
    Swal.fire({
        title: 'Memproses...',
        text: 'Sedang memperbarui status produk',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/products/{{ $product->id }}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: status,
            notes: notes,
            timestamp: currentTimestamp // Kirim timestamp saat ini
        })
    })
    .finally(() => {
        // Apapun hasilnya (berhasil atau error), cukup reload halaman
        // Kita tahu data berhasil tersimpan meskipun ada error di respons
        setTimeout(() => {
            Swal.fire({
                title: 'Selesai!',
                text: 'Halaman akan dimuat ulang untuk melihat perubahan',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.reload();
            });
        }, 500);
    });
}

</script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-[#678FAA] text-white py-4 px-6 w-full">
        <div class="w-full mx-auto">
            <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul">
            
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4">
    
        <div class="max-w-6xl mx-auto my-4">
        <h1 class="text-xl font-semibold text-center mb-1">Detail Produk</h1>
            <p class="text-sm text-center text-black/90 leading-tight px-4">
                Admin dapat mengkurasi produk.
            </p>
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
                    <div class="col-span-1" x-data="{ 
                        currentImageIndex: 0,
                        images: [
                            @foreach($product->photos as $photo)
                                '{{ $photo->url }}',
                            @endforeach
                        ],
                        goToNext() {
                            this.currentImageIndex = this.currentImageIndex === this.images.length - 1 ? 0 : this.currentImageIndex + 1;
                        },
                        goToPrev() {
                            this.currentImageIndex = this.currentImageIndex === 0 ? this.images.length - 1 : this.currentImageIndex - 1;
                        }
                    }">
                        <!-- Gambar Utama Produk -->
                        <div class="border rounded-md p-2 mb-4">
                            <div class="relative pb-[100%]">
                                <img :src="images[currentImageIndex]" 
                                    alt="{{ $product->name ?? 'Product Image' }}" 
                                    class="absolute inset-0 w-full h-full object-contain">
                                
                                <!-- Tombol Navigasi -->
                                <button 
                                    @click="goToPrev"
                                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-transparent hover:bg-white p-2 rounded-full shadow-md transition-all">
                                    <i class="fas fa-chevron-left text-gray-700"></i>
                                </button>
                                
                                <button 
                                    @click="goToNext"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-transparent hover:bg-white p-2 rounded-full shadow-md transition-all">
                                    <i class="fas fa-chevron-right text-gray-700"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Variasi Gambar -->
                        <div class="grid grid-cols-4 gap-2">
                            @if($product->photos && $product->photos->count() > 0)
                                @foreach($product->photos as $index => $photo)
                                    <div class="relative pb-[100%]">
                                        <img src="{{ $photo->url }}" 
                                            alt="{{ $product->name }}" 
                                            @click="currentImageIndex = {{ $index }}"
                                            :class="{ 'ring-2 ring-blue-500': currentImageIndex === {{ $index }} }"
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
                            <div class="space-x-2 variations-container">
                                @forelse ($product->variations as $variation)
                                    <button 
                                        data-variation-id="{{ $variation->id }}"
                                        class="inline-block bg-blue-500 text-white text-xs font-medium px-3 py-1 rounded-full hover:bg-blue-600 focus:ring focus:ring-blue-300"
                                        onclick="handleVariationClick('{{ $variation->id }}', '{{ $variation->name }}')"
                                    >
                                        {{ $variation->name }}
                                    </button>
                                @empty
                                    <span class="inline-block bg-gray-300 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                                        Tidak ada variasi
                                    </span>
                                @endforelse
                            </div>

                                <script>
                                   function handleVariationClick(id, name) {
                                    // Tandai tombol variasi yang aktif
                                    const variationButtons = document.querySelectorAll('button[data-variation-id]');
                                    variationButtons.forEach(button => {
                                        if (button.getAttribute('data-variation-id') === id) {
                                            button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                                            button.classList.add('bg-blue-700', 'hover:bg-blue-800', 'ring-2', 'ring-blue-300');
                                        } else {
                                            button.classList.remove('bg-blue-700', 'hover:bg-blue-800', 'ring-2', 'ring-blue-300');
                                            button.classList.add('bg-blue-500', 'hover:bg-blue-600');
                                        }
                                    });

                                    // Tampilkan loading
                                    

                                    // Kirim permintaan AJAX ke endpoint variasi
                                    fetch(`/detail/{{ $product->id }}/variation/${id}`, {
                                        method: 'GET',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Terjadi kesalahan saat mengambil data variasi');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log("Data variasi diterima:", data); // Tambahkan log untuk debugging
                                        
                                        if (data.success) {
                                            // Update konten halaman dengan data variasi
                                            updateProductDetails(data.variation);
                                            
                                            // Tampilkan pesan sukses
                                            
                                        } else {
                                            throw new Error(data.message || 'Terjadi kesalahan saat mengambil data variasi');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: error.message || 'Terjadi kesalahan saat mengambil data variasi',
                                            icon: 'error',
                                            confirmButtonText: 'Tutup'
                                        });
                                    });
                                }

                                function updateProductDetails(variation) {
                                    console.log("Updating product details with:", variation); // Tambahkan log untuk debugging
                                    
                                    // Update harga jika ada
                                    if (variation.price !== undefined && variation.price !== null) {
                                        const priceElement = document.querySelector('.text-2xl.font-bold.text-blue-600');
                                        if (priceElement) {
                                            priceElement.textContent = `Rp ${formatNumber(variation.price)}`;
                                        }
                                    }

                                    // Update deskripsi jika ada
                                    if (variation.description) {
                                        const descriptionElement = document.querySelector('.text-sm.text-gray-700.mb-6');
                                        if (descriptionElement) {
                                            descriptionElement.textContent = variation.description;
                                        }
                                    }

                                    // Update gambar jika ada
                                    if (variation.photos && variation.photos.length > 0) {
                                        console.log("Updating images with:", variation.photos); // Log foto untuk debugging
                                        
                                        // Update gambar utama
                                        const mainImage = document.querySelector('.w-full.h-full.object-contain');
                                        if (mainImage) {
                                            mainImage.src = variation.photos[0].url;
                                        }
                                        
                                        // Update tampilan Alpine.js
                                        const productImagesDiv = document.querySelector('[x-data]');
                                        if (productImagesDiv && window.Alpine) {
                                            try {
                                                // Dapatkan instance Alpine.js
                                                const alpineData = window.Alpine.$data(productImagesDiv);
                                                
                                                // Reset index dan update array gambar
                                                if (alpineData) {
                                                    alpineData.currentImageIndex = 0;
                                                    alpineData.images = variation.photos.map(photo => photo.url);
                                                    console.log("Alpine data updated with:", alpineData.images);
                                                }
                                            } catch (e) {
                                                console.error("Error updating Alpine data:", e);
                                            }
                                        }
                                        
                                        // Update thumbnail gambar
                                        const thumbnailContainer = document.querySelector('.grid.grid-cols-4.gap-2');
                                        if (thumbnailContainer && variation.photos.length > 0) {
                                            // Bersihkan thumbnail yang ada
                                            thumbnailContainer.innerHTML = '';
                                            
                                            // Buat thumbnail baru
                                            variation.photos.forEach((photo, index) => {
                                                const thumbDiv = document.createElement('div');
                                                thumbDiv.className = 'relative pb-[100%]';
                                                
                                                const img = document.createElement('img');
                                                img.src = photo.url;
                                                img.alt = variation.name || 'Product Variation';
                                                img.className = `absolute inset-0 w-full h-full object-cover rounded-lg shadow-sm cursor-pointer hover:opacity-75 transition-opacity ${index === 0 ? 'ring-2 ring-blue-500' : ''}`;
                                                
                                                // Tambahkan onclick handler untuk thumbnail
                                                img.onclick = function() {
                                                    // Update gambar utama
                                                    const mainImg = document.querySelector('.w-full.h-full.object-contain');
                                                    if (mainImg) {
                                                        mainImg.src = photo.url;
                                                    }
                                                    
                                                    // Update index di Alpine.js jika tersedia
                                                    if (productImagesDiv && window.Alpine) {
                                                        try {
                                                            const alpineData = window.Alpine.$data(productImagesDiv);
                                                            if (alpineData) {
                                                                alpineData.currentImageIndex = index;
                                                            }
                                                        } catch (e) {
                                                            console.error("Error updating Alpine index:", e);
                                                        }
                                                    }
                                                    
                                                    // Update highlight pada thumbnail
                                                    thumbnailContainer.querySelectorAll('img').forEach((thumb, i) => {
                                                        if (i === index) {
                                                            thumb.classList.add('ring-2', 'ring-blue-500');
                                                        } else {
                                                            thumb.classList.remove('ring-2', 'ring-blue-500');
                                                        }
                                                    });
                                                };
                                                
                                                thumbDiv.appendChild(img);
                                                thumbnailContainer.appendChild(thumbDiv);
                                            });
                                        }
                                    }

                                // Update warna jika ada
                                if (variation.colors && Array.isArray(variation.colors)) {
                                    const colorsContainer = document.querySelector('.flex.gap-2.mb-4');
                                    if (colorsContainer) {
                                        colorsContainer.innerHTML = '';
                                        variation.colors.forEach((color, index) => {
                                            const isActive = index === 0;
                                            const colorSpan = document.createElement('span');
                                            colorSpan.className = `border px-3 py-1 rounded-full text-xs ${isActive ? 'bg-blue-100 border-blue-500 text-blue-500' : ''}`;
                                            colorSpan.textContent = color;
                                            
                                            // Tambahkan event click untuk memilih warna
                                            colorSpan.addEventListener('click', function() {
                                                // Update highlight
                                                colorsContainer.querySelectorAll('span').forEach(span => {
                                                    span.classList.remove('bg-blue-100', 'border-blue-500', 'text-blue-500');
                                                });
                                                this.classList.add('bg-blue-100', 'border-blue-500', 'text-blue-500');
                                            });
                                            
                                            colorsContainer.appendChild(colorSpan);
                                        });
                                    }
                                }

                                // Update ukuran jika ada
                                if (variation.sizes && Array.isArray(variation.sizes)) {
                                    const sizesContainer = document.querySelector('.flex.gap-2:not(.mb-4)'); // Untuk membedakan dari container warna
                                    if (sizesContainer) {
                                        sizesContainer.innerHTML = '';
                                        variation.sizes.forEach((size, index) => {
                                            const isActive = index === 0;
                                            const sizeSpan = document.createElement('span');
                                            sizeSpan.className = `border w-8 h-8 flex items-center justify-center rounded-full text-xs ${isActive ? 'bg-blue-100 border-blue-500 text-blue-500' : ''}`;
                                            sizeSpan.textContent = size;
                                            
                                            // Tambahkan event click untuk memilih ukuran
                                            sizeSpan.addEventListener('click', function() {
                                                // Update highlight
                                                sizesContainer.querySelectorAll('span').forEach(span => {
                                                    span.classList.remove('bg-blue-100', 'border-blue-500', 'text-blue-500');
                                                });
                                                this.classList.add('bg-blue-100', 'border-blue-500', 'text-blue-500');
                                            });
                                            
                                            sizesContainer.appendChild(sizeSpan);
                                        });
                                    }
                                }
                            }

                            // Fungsi pembantu untuk format angka
                            function formatNumber(number) {
                                return new Intl.NumberFormat('id-ID').format(number);
                            }
                            // Menambahkan fungsi untuk dijalankan saat halaman dimuat
                            document.addEventListener('DOMContentLoaded', function() {
                                // Cari tombol variasi pertama
                                const firstVariationButton = document.querySelector('.variations-container button[data-variation-id]');
                                
                                // Jika ada tombol variasi
                                if (firstVariationButton) {
                                    // Dapatkan ID dan nama variasi
                                    const variationId = firstVariationButton.getAttribute('data-variation-id');
                                    const variationName = firstVariationButton.textContent.trim();
                                    
                                    // Aktifkan variasi pertama
                                    console.log('Mengaktifkan variasi pertama:', variationName);
                                    
                                    // Ubah tampilan tombol untuk menandakan aktif
                                    firstVariationButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                                    firstVariationButton.classList.add('bg-blue-700', 'hover:bg-blue-800', 'ring-2', 'ring-blue-300');
                                    
                                    // Panggil fungsi untuk mengambil data variasi
                                    handleVariationClick(variationId, variationName);
                                }
                            });

                            
                                </script>

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
                        <!-- Action Buttons with SweetAlert2 -->
                        @php
                            $isProcessed = false;
                            $statusProcessed = '';
                            
                            // Cek apakah produk sudah pernah diterima atau ditolak
                            foreach($timeline as $item) {
                                if(strtolower($item['status']) === 'diterima' || strtolower($item['status']) === 'ditolak') {
                                    $isProcessed = true;
                                    $statusProcessed = $item['status'];
                                    break;
                                }
                            }
                        @endphp

                        @if(!$isProcessed)
                            <h3 class="text-lg font-medium mb-4">Pilih Status:</h3>
                            <div class="flex justify-start mb-6 gap-2">
                                <!-- Terima Button -->
                                <button 
                                    onclick="confirmAccept()"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Terima
                                </button>

                                <!-- Diterima Dengan Revisi Button -->
                                <button 
                                    onclick="revisionWithNote()"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Diterima Dengan Revisi
                                </button>

                                <!-- Tolak Button -->
                                <button 
                                    onclick="confirmReject()"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Tolak
                                </button>
                            </div>
                        @else
                            <div class="p-4 rounded-md mb-6 
                            @if(strtolower($statusProcessed) === 'diterima')
                                bg-green-100
                            @elseif(strtolower($statusProcessed) === 'ditolak')
                                bg-red-100
                            @else
                                bg-gray-100
                            @endif">
                                <p class="
                                @if(strtolower($statusProcessed) === 'diterima')
                                    text-green-700
                                @elseif(strtolower($statusProcessed) === 'ditolak')
                                    text-red-700
                                @else
                                    text-gray-700
                                @endif font-medium">
                                    Produk ini sudah {{ $statusProcessed }} dan tidak dapat diubah statusnya.
                                </p>
                            </div>
                        @endif

                        <!-- Timeline -->
                        <!-- Timeline -->
            <!-- In detailproduk.blade.php, replace the existing Timeline section with: -->
                <!-- Timeline -->
                <div>
                    <h3 class="text-lg font-medium mb-4">Timeline Status:</h3>
                    <div class="relative">
                        <div class="absolute h-full w-px bg-gray-300 left-4"></div>
                        <div class="ml-8 space-y-8">
                            @foreach($timeline as $item)
                            <div class="relative">
                                <div class="absolute -left-8 mt-1.5">
                                    <div class="w-4 h-4 rounded-full border-4 border-white"
                                        @class([
                                            'bg-blue-500' => $item['color'] === 'blue',
                                            'bg-green-500' => $item['color'] === 'green',
                                            'bg-red-500' => $item['color'] === 'red',
                                            'bg-yellow-500' => $item['color'] === 'yellow',
                                            'bg-gray-500' => $item['color'] === 'gray',
                                        ])></div>
                                </div>
                                <div>
                                    <h4 @class([
                                        'text-base font-semibold',
                                        'text-blue-600' => $item['color'] === 'blue',
                                        'text-green-600' => $item['color'] === 'green',
                                        'text-red-600' => $item['color'] === 'red',
                                        'text-yellow-600' => $item['color'] === 'yellow',
                                        'text-gray-600' => $item['color'] === 'gray',
                                    ])>{{ $item['status'] }}</h4>
                                    
                                    @if(isset($item['notes']) && !empty($item['notes']) && $item['notes'] !== 'Tidak ada catatan')
                                        <p class="text-sm text-gray-500">Catatan:</p>
                                        <p class="text-sm text-gray-500">{{ $item['notes'] }}</p>
                                    @endif
                                    
                                    <div class="flex items-center gap-2 text-xs text-gray-400">
                                        <span>Oleh: {{ $item['admin'] }}</span>
                                        <span>•</span>
                                        <span>{{ $item['created_at']->format('d F Y H:i') }}</span>
                                        <span>WIB</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
