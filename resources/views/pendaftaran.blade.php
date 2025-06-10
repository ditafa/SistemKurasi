<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulir Pendaftaran - Kurasi Bantul</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen flex flex-col bg-[#F8FFF9] text-gray-700">

    <!-- Wrapper sidebar + main content -->
    <div class="flex flex-1">
        <!-- Sidebar Desktop -->
        <aside class="hidden md:block w-64 bg-[#14532D] text-white p-6">
            <div class="flex flex-col h-full">
                <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12 mb-8" />
                <nav class="flex flex-col space-y-4 text-sm font-medium">
                    <a href="/" class="hover:text-green-200">Beranda</a>
                    <a href="/about" class="hover:text-green-200">Tentang Kami</a>
                    <a href="/kontak" class="hover:text-green-200">Kontak</a>
                    <div class="mt-6 border-t border-white/20 pt-4">
                        <p class="text-xs mb-2">Masuk Sebagai:</p>
                        <a href="/login-admin" class="block hover:text-green-200">Admin</a>
                        <a href="/login-pedagang" class="block hover:text-green-200">Pedagang</a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Sidebar Mobile Overlay -->
        <div
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity>
        </div>

        <!-- Sidebar Mobile Slide -->
        <div
            class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
        >
            <div class="flex justify-between items-center mb-6">
                <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12" />
                <button class="text-white text-2xl font-bold" @click="sidebarOpen = false">×</button>
            </div>
            <nav class="flex flex-col space-y-4 text-sm font-medium">
                <a href="/" class="hover:text-green-200">Beranda</a>
                <a href="/about" class="hover:text-green-200">Tentang Kami</a>
                <a href="/kontak" class="hover:text-green-200">Kontak</a>
                <div class="mt-4 border-t border-white/20 pt-4">
                    <p class="text-xs mb-2">Masuk Sebagai:</p>
                    <a href="/login-admin" class="block hover:text-green-200">Admin</a>
                    <a href="/login-pedagang" class="block hover:text-green-200">Pedagang</a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6">Formulir Pendaftaran Kurasi Produk</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('pendaftaran.submit') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Informasi Pelaku Usaha</h3>

                        <label class="block">Nama Pemilik:</label>
                        <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Nama Usaha:</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Nomor WhatsApp:</label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Alamat Lengkap:</label>
                        <textarea name="alamat" required class="w-full p-2 border rounded">{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Informasi Produk</h3>

                        <label class="block">Nama Produk:</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Kategori Produk:</label>
                        <select name="kategori" required class="w-full p-2 border rounded">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="fashion" {{ old('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="kerajinan" {{ old('kategori') == 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>

                        <label class="block mt-4">Deskripsi Produk:</label>
                        <textarea name="deskripsi" required class="w-full p-2 border rounded">{{ old('deskripsi') }}</textarea>

                        <label class="block mt-4">Harga (Rp):</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" required class="w-full p-2 border rounded" />

                        <label class="block mt-4">Upload Foto Produk (maks. 5 foto):</label>
                        <input
                            type="file"
                            name="foto[]"
                            accept="image/*"
                            multiple
                            required
                            class="w-full p-2 border rounded bg-white"
                        />
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-2 bg-green-700 text-white rounded hover:bg-green-800">
                        Kirim
                    </button>
                </div>
            </form>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#14532D] text-white py-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.</p>
    </footer>

</body>
</html>
