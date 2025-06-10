<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Produk - Kurasi Bantul</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <!-- Body flex-col dan min-h-screen untuk sticky footer -->
  <body class="bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

    <!-- Sidebar (desktop) -->
    <aside
      class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-40"
    >
      <div>
        <!-- Logo -->
        <div class="flex items-center justify-between mb-10">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-11"
          />
        </div>

        <!-- Navigasi -->
        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a
              href="{{ route('pedagang.dashboard') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Dashboard</a
            >
            <a
              href="{{ route('pedagang.produk.index') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Daftar Produk</a
            >
            <a
              href="{{ route('pedagang.notifikasi') }}"
              class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
              >Notifikasi</a
            >
            <form action="{{ route('pedagang.logout') }}" method="POST">
              @csrf
              <button
                type="submit"
                class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition"
              >
                Logout
              </button>
            </form>
          </div>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <!-- Ganti flex-1 jadi flex-grow supaya footer bisa nempel bawah -->
    <main class="flex-grow p-6 md:ml-64 flex flex-col items-center w-full">
      <header class="max-w-4xl mb-6 w-full">
        <h1 class="text-3xl font-extrabold text-[#4a8a4a] mb-2">Tambah Produk</h1>
        <p class="text-sm text-gray-600">
          Lengkapi data produk sebelum mengirim kurasi.
        </p>
      </header>

      <!-- Alert -->
      @if (session('success'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4 w-full max-w-4xl">
        {{ session('success') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 w-full max-w-4xl">
        <ul class="list-disc pl-5 text-sm">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <!-- Form -->
      <section
        class="bg-[#f0f7e9] border border-[#a3c0d1] p-6 rounded-xl shadow-sm max-w-4xl w-full"
        x-data="productForm()"
        x-init="init()"
      >
        <form
          method="POST"
          action="{{ route('pedagang.produk.store') }}"
          enctype="multipart/form-data"
          class="space-y-5"
          @submit.prevent="submitForm()"
        >
          @csrf

          <!-- Gambar Produk -->
          <div>
            <label class="block text-sm font-semibold mb-1"
              >Foto Produk (max 3 gambar)</label
            >
            <input
              type="file"
              name="gambar[]"
              accept="image/*"
              multiple
              @change="handleFiles"
              class="w-full border rounded p-2"
            />

            <template x-if="previews.length">
              <div class="mt-3 flex gap-3">
                <template x-for="(src, index) in previews" :key="index">
                  <div class="relative w-20 h-20 border rounded overflow-hidden">
                    <img
                      :src="src"
                      alt="Preview"
                      class="w-full h-full object-cover"
                    />
                    <button
                      type="button"
                      @click="removeImage(index)"
                      class="absolute top-0 right-0 bg-red-600 text-white rounded-bl px-1"
                    >
                      ×
                    </button>
                  </div>
                </template>
              </div>
            </template>
            <p
              x-show="errorMsg"
              x-text="errorMsg"
              class="text-red-600 text-sm mt-1"
            ></p>
          </div>

          <!-- Nama Produk -->
          <div>
            <label class="block text-sm font-semibold mb-1">Nama Produk</label>
            <input
              type="text"
              name="name"
              value="{{ old('name') }}"
              required
              class="w-full border rounded p-2"
            />
          </div>

          <!-- Kategori -->
          <div>
            <label class="block text-sm font-semibold mb-1">Kategori</label>
            <select
              name="category_id"
              required
              class="w-full border rounded p-2"
            >
              <option value="" disabled {{ old('category_id') ? '' : 'selected' }}
                >-- Pilih Kategori --</option
              >
              @foreach ($categories as $category)
              <option
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}
              >
                {{ $category->name }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="block text-sm font-semibold mb-1">Deskripsi</label>
            <textarea
              name="description"
              rows="4"
              class="w-full border rounded p-2"
            >{{ old('description') }}</textarea>
          </div>

          <!-- Jenis Produk -->
          <div>
            <label class="block text-sm font-semibold mb-1">Jenis Produk</label>
            <div class="flex gap-4">
              <label class="inline-flex items-center">
                <input
                  type="radio"
                  value="single"
                  name="type"
                  x-model="type"
                  class="form-radio"
                />
                <span class="ml-2">Single</span>
              </label>
              <label class="inline-flex items-center">
                <input
                  type="radio"
                  value="variation"
                  name="type"
                  x-model="type"
                  class="form-radio"
                />
                <span class="ml-2">Variation</span>
              </label>
            </div>
          </div>

          <!-- Warna & Ukuran -->
          <div x-show="type === 'variation'" x-transition class="mt-3 space-y-4">
            <div>
              <label class="block text-sm font-semibold mb-1">Warna</label>
              <div class="flex flex-wrap gap-4">
                <template
                  x-for="warna in ['merah', 'biru', 'hijau', 'kuning', 'hitam', 'putih']"
                  :key="warna"
                >
                  <label class="inline-flex items-center cursor-pointer">
                    <input
                      type="checkbox"
                      :value="warna"
                      name="color[]"
                      class="form-checkbox"
                      x-model="selectedColors"
                    />
                    <span
                      class="ml-2"
                      x-text="warna.charAt(0).toUpperCase() + warna.slice(1)"
                    ></span>
                  </label>
                </template>
              </div>
            </div>

            <div>
              <label class="block text-sm font-semibold mb-1">Ukuran Size</label>
              <div class="flex flex-wrap gap-4">
                <template x-for="ukuran in ['S', 'M', 'L', 'XL', 'XXL']" :key="ukuran">
                  <label class="inline-flex items-center cursor-pointer">
                    <input
                      type="checkbox"
                      :value="ukuran"
                      name="size[]"
                      class="form-checkbox"
                      x-model="selectedSizes"
                    />
                    <span class="ml-2" x-text="ukuran"></span>
                  </label>
                </template>
              </div>
            </div>

            <div>
              <label class="block text-sm font-semibold mb-1">Ukuran Berat</label>
              <div class="flex flex-wrap gap-4">
                <template x-for="ukuran in ['Gram', 'Ons', 'Liter', 'Ml']" :key="ukuran">
                  <label class="inline-flex items-center cursor-pointer">
                    <input
                      type="checkbox"
                      :value="ukuran"
                      name="size[]"
                      class="form-checkbox"
                      x-model="selectedSizes"
                    />
                    <span class="ml-2" x-text="ukuran"></span>
                  </label>
                </template>
              </div>
            </div>

            <!-- Harga per Variasi -->
            <div
              x-show="selectedColors.length && selectedSizes.length"
              class="mt-4 border-t pt-4"
            >
              <h3 class="font-semibold mb-2">Harga per Variasi</h3>
              <template x-for="color in selectedColors" :key="color">
                <div class="mb-4">
                  <h4 class="font-medium mb-1" x-text="color.charAt(0).toUpperCase() + color.slice(1)"></h4>
                  <template x-for="size in selectedSizes" :key="size">
                    <div class="flex items-center mb-2 gap-2">
                      <label class="w-12" x-text="size"></label>
                      <input
                        type="number"
                        :name="`price_variation[${color}][${size}]`"
                        min="0"
                        placeholder="Harga (Rp)"
                        class="border rounded p-1 w-32"
                        required
                      />
                    </div>
                  </template>
                </div>
              </template>
            </div>
          </div>

          <!-- Harga untuk Single -->
          <div x-show="type === 'single'" class="mt-3">
            <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
            <input
              type="number"
              name="price"
              value="{{ old('price') }}"
              min="0"
              required
              class="w-full border rounded p-2"
            />
          </div>

          <!-- Status (Hidden) -->
          <input type="hidden" name="status" value="diajukan" />

          <!-- Tombol Simpan -->
          <div class="text-right">
            <button
              type="submit"
              class="bg-[#4a8a4a] hover:bg-green-700 text-white px-6 py-2 rounded font-semibold"
            >
              Simpan Produk
            </button>
          </div>
        </form>
      </section>
    </main>

    <!-- Footer -->
    <!-- Tambahkan w-full dan mt-auto supaya footer full width dan nempel bawah -->
    <footer class="bg-[#14532D] text-white text-sm py-6 text-center w-full mt-auto">
      <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
    </footer>

    <!-- Alpine.js Logic -->
    <script>
      function productForm() {
        return {
          type: @json(old("type", "single")),
          previews: [],
          errorMsg: "",

          selectedColors: [],
          selectedSizes: [],

          init() {
            // load old input jika ada (Laravel)
            this.selectedColors = @json(old("color", []));
            this.selectedSizes = @json(old("size", []));
          },

          handleFiles(event) {
            this.errorMsg = "";
            const files = Array.from(event.target.files);
            if (files.length > 3) {
              this.errorMsg = "Maksimal upload 3 gambar saja.";
              event.target.value = "";
              this.previews = [];
              return;
            }
            this.previews = [];
            files.forEach((file) => {
              if (!file.type.startsWith("image/")) return;
              const reader = new FileReader();
              reader.onload = (e) => {
                this.previews.push(e.target.result);
              };
              reader.readAsDataURL(file);
            });
          },

          removeImage(index) {
            this.previews.splice(index, 1);
          },

          submitForm() {
            this.errorMsg = "";

            if (this.previews.length === 0) {
              this.errorMsg = "Harap upload minimal 1 foto produk.";
              return;
            }
            if (this.previews.length > 3) {
              this.errorMsg = "Maksimal upload 3 gambar saja.";
              return;
            }

            if (this.type === "variation") {
              if (this.selectedColors.length === 0) {
                this.errorMsg = "Harap pilih minimal 1 warna.";
                return;
              }
              if (this.selectedSizes.length === 0) {
                this.errorMsg = "Harap pilih minimal 1 ukuran.";
                return;
              }

              // Validasi harga variasi harus terisi semua
              let valid = true;
              const form = this.$root.querySelector("form");
              this.selectedColors.forEach((color) => {
                this.selectedSizes.forEach((size) => {
                  const inputName = `price_variation[${color}][${size}]`;
                  const input = form.querySelector(`[name="${inputName}"]`);
                  if (!input || !input.value || Number(input.value) < 0) {
                    valid = false;
                  }
                });
              });
              if (!valid) {
                this.errorMsg =
                  "Harap isi harga untuk semua variasi warna dan ukuran.";
                return;
              }
            }

            this.$root.querySelector("form").submit();
          },
        };
      }
    </script>
  </body>
</html>
