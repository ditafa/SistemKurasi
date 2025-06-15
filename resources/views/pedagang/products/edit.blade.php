<!DOCTYPE html>
<html lang="id" x-data="produkForm()" x-init="initEdit()" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col">
  <div class="flex flex-1">
    <!-- SIDEBAR -->
    <aside class="hidden md:flex md:flex-col md:w-64 fixed h-screen bg-[#14532D] text-white p-6 z-10">
      <img src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png" alt="Logo" class="h-12 mb-8">
      <nav class="flex flex-col gap-2 text-sm">
        <a href="/" class="hover:text-green-200">Beranda</a>
        <a href="/about" class="hover:text-green-200">Tentang Kami</a>
        <a href="/kontak" class="hover:text-green-200">Kontak</a>
        <hr class="border-white/30 my-4">
        <a href="{{ route('pedagang.dashboard') }}" class="hover:text-green-200">Dashboard</a>
        <a href="{{ route('pedagang.produk.index') }}" class="hover:text-green-200">Daftar Produk</a>
        <a href="{{ route('pedagang.notifikasi') }}" class="hover:text-green-200">Notifikasi</a>
        <a href="{{ route('pedagang.statistik') }}" class="hover:text-green-200">Statistik</a>
        <form action="{{ route('pedagang.logout') }}" method="POST">@csrf
          <button type="submit" class="text-left hover:text-green-200">Logout</button>
        </form>
      </nav>
    </aside>

    <!-- FORM -->
    <main class="flex-1 ml-0 md:ml-64 p-6 bg-gray-100 min-h-screen">
      <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

        <form method="POST" action="{{ route('pedagang.produk.update', $product->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          @if ($errors->any())
          <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
              <label class="block font-semibold mb-2">Foto Produk (maks. 3)</label>
              <input type="file" name="gambar[]" multiple accept="image/*" class="border rounded w-full p-2" @change="handlePreview($event)">
              <div class="mt-3 grid grid-cols-3 gap-2">
                @foreach ($product->photos as $img)
                  <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-28 object-cover rounded border">
              @endforeach

              </div>
              <div class="mt-3 grid grid-cols-3 gap-2" x-show="previewImages.length > 0">
                <template x-for="(img, index) in previewImages" :key="index">
                  <img :src="img" class="w-full h-28 object-cover rounded border">
                </template>
              </div>
            </div>

            <div class="md:w-2/3 space-y-4">
              <div>
                <label class="block font-semibold mb-1">Nama Produk</label>
                <input type="text" name="name" class="border rounded w-full p-2" required value="{{ old('name', $product->name) }}">
              </div>

              <div>
                <label class="block font-semibold mb-1">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded bg-white" required>
                  <option value="">Pilih Kategori</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @foreach($category->children as $child)
                      <option value="{{ $child->id }}" {{ $product->category_id == $child->id ? 'selected' : '' }}>
                        {{ $category->name }} > {{ $child->name }}
                      </option>
                      @foreach($child->children as $sub)
                        <option value="{{ $sub->id }}" {{ $product->category_id == $sub->id ? 'selected' : '' }}>
                          {{ $category->name }} > {{ $child->name }} > {{ $sub->name }}
                        </option>
                      @endforeach
                    @endforeach
                  @endforeach
                </select>
              </div>

              <div>
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" rows="3" class="border rounded w-full p-2" required>{{ old('description', $product->description) }}</textarea>
              </div>

              <div>
                <label class="block font-semibold mb-1">Jenis Produk</label>
                <label class="mr-4">
                  <input type="radio" value="single" name="type" x-model="jenis" {{ $product->type === 'single' ? 'checked' : '' }} class="mr-1"> Single
                </label>
                <label>
                  <input type="radio" value="variation" name="type" x-model="jenis" {{ $product->type === 'variation' ? 'checked' : '' }} class="mr-1"> Variation
                </label>
              </div>

              <div x-show="jenis === 'single'">
                <label class="block font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="price" class="border rounded w-full p-2" value="{{ old('price', $product->price) }}">
              </div>

              <div>
                <label class="block font-semibold mb-1 mt-2">Status Produk</label>
                <select name="status" class="border rounded w-full p-2" required>
                  <option value="diajukan" {{ $product->status === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                  <option value="diterima" {{ $product->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                  <option value="ditolak" {{ $product->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                  <option value="revisi" {{ $product->status === 'revisi' ? 'selected' : '' }}>Revisi</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Variasi Produk -->
          <div x-show="jenis === 'variation'" class="mt-6 border-t pt-6">
            <h2 class="text-lg font-semibold mb-4">Variasi Produk</h2>

            <template x-for="(options, label) in attributeOptions" :key="label">
              <div class="mb-4">
                <label class="block font-semibold mb-1" x-text="label"></label>
                <select multiple class="w-full border rounded p-2"
                        @change="selectedValues[label] = Array.from($event.target.selectedOptions).map(o => o.value); generateCombinations();">
                  <template x-for="option in options" :key="option">
                    <option :value="option" x-text="option"
                      :selected="(selectedValues[label] || []).includes(option)"></option>
                  </template>
                </select>
              </div>
            </template>

            <div x-show="kombinasi.length > 0" class="mt-6">
              <h3 class="text-md font-bold mb-2">Kombinasi Variasi</h3>
              <table class="w-full border text-sm text-left">
                <thead>
                  <tr class="bg-gray-200 text-gray-700">
                    <th class="p-2 border">Kombinasi</th>
                    <th class="p-2 border">Harga (Rp)</th>
                    <th class="p-2 border">Stok</th>
                  </tr>
                </thead>
                <tbody>
                  <template x-for="(item, index) in kombinasi" :key="index">
                    <tr>
                      <td class="p-2 border" x-text="item.label"></td>
                      <td class="p-2 border">
                        <input type="number" :name="'kombinasi[' + index + '][price]'" class="w-full border p-1 rounded"
                               :value="item.price" required>
                      </td>
                      <td class="p-2 border">
                        <input type="number" :name="'kombinasi[' + index + '][stock]'" class="w-full border p-1 rounded"
                               :value="item.stock" required>
                      </td>
                      <input type="hidden" :name="'kombinasi[' + index + '][label]'" :value="item.label">
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>

          <div class="text-right mt-6">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">
              Perbarui Produk
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <script>
    function produkForm() {
      return {
        jenis: '{{ old('type', $product->type) }}',
        previewImages: [],
        attributeOptions: {
          Warna: ['Merah', 'Kuning', 'Biru', 'Hijau', 'Hitam', 'Putih'],
          'Ukuran Baju': ['S', 'M', 'L', 'XL', 'XXL'],
          'Ukuran Kaki': ['35','36','37','38','39','40','41','42','43','44','45'],
          Berat: ['100gr', '250gr', '500gr', '1kg'],
          Volume: ['250ml', '500ml', '1L'],
          Rasa: ['Original', 'Keju', 'Cokelat', 'Pedas'],
        },
        selectedValues: @json($selectedValues ?? []),
        kombinasi: [],
        productVariations: @json($product->variations ?? []),
        handlePreview(event) {
          this.previewImages = [];
          const files = event.target.files;
          if (files.length > 3) {
            alert("Maksimal 3 gambar yang bisa diunggah.");
            event.target.value = "";
            return;
          }
          Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
              this.previewImages.push(e.target.result);
            };
            reader.readAsDataURL(file);
          });
        },
        generateCombinations() {
          const entries = Object.entries(this.selectedValues).filter(([k, v]) => v.length);
          if (entries.length < 2) {
            this.kombinasi = [];
            return;
          }
          const cartesian = (arr) => arr.reduce((a, b) => a.flatMap(d => b.map(e => [].concat(d, e))));
          const result = cartesian(entries.map(([_, v]) => v));
          this.kombinasi = result.map(combo => {
            const label = combo.join(' + ');
            const existing = this.productVariations.find(p => p.label === label);
            return {
              label,
              price: existing ? existing.price : '',
              stock: existing ? existing.stock : ''
            };
          });
        },
        initEdit() {
          if (this.jenis === 'variation') {
            this.generateCombinations();
          }
        }
      }
    }
  </script>
</body>
</html>
