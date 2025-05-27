<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Halaman Produk Kurasi - Dashboard Kurasi Bantul</title>
  <link rel="icon" href="https://diskominfo.bantulkab.go.id/assets/Site/img/favicon.png" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#dff5e3] text-[#555555]">

  <!-- Navbar -->
  <nav class="bg-[#2ecc71] flex items-center justify-between px-6 py-4 shadow-md">
    <div class="flex items-center space-x-3">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo Bantul" class="h-12" />
    </div>
    <div class="hidden md:flex space-x-8 items-center text-white font-semibold">
      <a href="/" class="hover:text-gray-200">Beranda</a>
      <a href="/about" class="hover:text-gray-200">Tentang Kami</a>
      <a href="/kontak" class="hover:text-gray-200">Kontak</a>
      <a href="/kontak" class="hover:text-gray-200">Profile</a>
      <div class="relative" x-data="{ open: false }">
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="flex-grow p-4">
    <h1 class="text-xl font-semibold text-center mb-1">Daftar Produk</h1>
    <p class="text-sm text-center text-black/90 leading-tight px-4">
      Admin dapat meninjau setiap produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
    </p>

    <div class="px-4 sm:px-10 py-6 max-w-7xl mx-auto">
      <a
        class="inline-flex items-center text-[#6b8ca3] font-semibold text-sm sm:text-base mb-6 select-none"
        href="#"
      >
        <i class="fas fa-arrow-left mr-2"></i>
        Kembali Ke Daftar Produk
      </a>

      <section
        class="bg-white rounded-2xl p-6 sm:p-10 shadow-lg flex flex-col sm:flex-row gap-8 sm:gap-16"
      >
        <!-- Image Section -->
        <div
          class="flex flex-col items-center space-y-4 sm:space-y-6"
        >
          <div
            class="w-72 h-72 sm:w-80 sm:h-80 rounded-2xl shadow-lg relative flex items-center justify-center"
          >
            <button
              aria-label="Previous image"
              class="absolute left-6 text-[#6b8ca3] text-2xl sm:text-3xl cursor-pointer select-none"
              type="button"
            >
              <i class="fas fa-chevron-left"></i>
            </button>
            <button
              aria-label="Next image"
              class="absolute right-6 text-[#6b8ca3] text-2xl sm:text-3xl cursor-pointer select-none"
              type="button"
            >
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
          <div class="flex space-x-6">
            <img
              class="w-24 h-24 rounded-2xl shadow-md object-cover"
              src="https://storage.googleapis.com/a1aa/image/8b8a0423-4dbb-4434-e4a4-4c2bd1f643ed.jpg"
              alt="Thumbnail 1"
            />
            <img
              class="w-24 h-24 rounded-2xl shadow-md object-cover"
              src="https://storage.googleapis.com/a1aa/image/27ae95a6-bedb-40ca-1029-e596dae53239.jpg"
              alt="Thumbnail 2"
            />
            <img
              class="w-24 h-24 rounded-2xl shadow-md object-cover"
              src="https://storage.googleapis.com/a1aa/image/ad2f9185-15b6-4f86-da76-da97510ac358.jpg"
              alt="Thumbnail 3"
            />
          </div>
          <!-- Tombol Upload dan Input File -->
          <input
            type="file"
            id="upload-foto"
            accept="image/*"
            class="hidden"
            multiple
          />
          <label for="upload-foto">
            <span
              class="text-xs text-[#6b8ca3] border border-[#6b8ca3] rounded-full px-3 py-0.5 select-none cursor-pointer hover:bg-[#6b8ca3] hover:text-white transition"
              >Upload Foto</span
            >
          </label>
        </div>

        <!-- Form Section -->
        <form
          class="flex-1 max-w-lg flex flex-col justify-between"
          x-data="{ kategori: '', lainnya: false, kategoriLainnya: '' }"
          @submit.prevent="
            let finalKategori = kategori === 'lainnya' ? kategoriLainnya.trim() : kategori;
            if (!finalKategori) {
              alert('Silakan pilih atau isi kategori produk');
              return;
            }
            // Bisa kirim form ke server di sini
            alert('Form akan diajukan dengan kategori: ' + finalKategori);
          "
        >
          <div class="space-y-4">
            <div>
              <label
                for="nama-produk"
                class="block text-gray-700 font-semibold text-sm mb-1"
                >Nama Produk</label
              >
              <input
                type="text"
                id="nama-produk"
                placeholder="Masukkan Nama Produk Anda"
                class="w-full bg-[#f7f7f2] text-xs text-gray-400 px-2 py-1 rounded-sm focus:outline-none"
                required
              />
            </div>

            <!-- Dropdown Kategori -->
            <div>
              <label
                for="kategori"
                class="block text-gray-700 font-semibold text-sm mb-1"
                >Kategori</label
              >
              <select
                x-model="kategori"
                @change="lainnya = (kategori === 'lainnya')"
                id="kategori"
                class="text-[#6b8ca3] text-xs border border-[#6b8ca3] rounded px-2 py-1 w-full cursor-pointer"
                required
              >
                <option value="" disabled selected>Pilih Kategori ▼</option>
                <option value="kaos">Kaos</option>
                <option value="kemeja">Kemeja</option>
                <option value="sepatu">Sepatu</option>
                <option value="makanan">Makanan</option>
                <option value="lainnya">Lainnya</option>
              </select>

              <!-- Input kategori lain -->
              <template x-if="lainnya">
                <div class="mt-2">
                  <input
                    type="text"
                    x-model="kategoriLainnya"
                    placeholder="Tulis kategori lainnya"
                    class="w-full bg-[#f7f7f2] text-xs text-gray-400 px-2 py-1 rounded-sm focus:outline-none"
                    required
                  />
                </div>
              </template>
            </div>

            <div>
              <label
                for="deskripsi"
                class="block text-gray-700 font-semibold text-sm mb-1"
                >Deskripsi :</label
              >
              <textarea
                id="deskripsi"
                rows="4"
                placeholder="Masukkan Deskripsi"
                class="w-full bg-[#f7f7f2] text-xs text-gray-400 px-2 py-1 rounded-sm resize-none focus:outline-none"
                required
              ></textarea>
            </div>

            <div>
            <label
              for="harga"
              class="block text-gray-700 font-semibold text-sm mb-1"
            >Harga :</label>
            <input
              type="text"
              id="harga"
              placeholder="Masukkan Harga"
              x-model="harga"
              @input="
                // Hapus semua selain angka
                let onlyNumbers = $event.target.value.replace(/[^0-9]/g, '');
                // Format jadi Rp. dengan ribuan
                let formatted = new Intl.NumberFormat('id-ID').format(onlyNumbers);
                $event.target.value = formatted ? 'Rp. ' + formatted : '';
                harga = onlyNumbers; // Simpan angka asli tanpa format di variabel harga
              "
              class="w-full bg-[#f7f7f2] text-xs text-gray-400 px-2 py-1 rounded-sm focus:outline-none"
              required
            />
          </div>

            <div>
              <label for="stok" class="block text-gray-700 font-semibold text-sm mb-1">Stok :</label>
              <input
                type="number"
                id="stok"
                min="0"
                step="1"
                placeholder="Masukkan jumlah stok"
                class="w-full bg-[#f7f7f2] text-xs text-gray-400 px-2 py-1 rounded-sm focus:outline-none"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                required
              />
            </div>

            <div>
              <p class="text-[#6b8ca3] font-semibold text-base select-none">
                Status kurasi :
              </p>
            </div>
          </div>

          <!-- Tombol Ajukan -->
          <div class="mt-6 text-right">
            <button
              type="submit"
              class="bg-[#2ecc71] text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-green-600 transition"
            >
              Ajukan
            </button>
          </div>
        </form>
      </section>
    </div>
  </main>

</body>
</html>
