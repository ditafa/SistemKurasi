<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Produk Pedagang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
  </head>
  <body
    class="bg-[#F8FFF9] text-gray-700 font-sans min-h-screen flex flex-col"
  >
    <div class="flex flex-1">
      <!-- Sidebar Desktop -->
      <aside
        class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10"
      >
        <div>
          <div class="flex items-center justify-between mb-10">
            <img
              src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
              alt="Logo"
              class="h-12"
            />
          </div>
          <nav class="flex flex-col space-y-4 text-sm font-medium">
            <a href="/" class="hover:text-green-200">Beranda</a>
            <a href="/about" class="hover:text-green-200">Tentang Kami</a>
            <a href="/kontak" class="hover:text-green-200">Kontak</a>
            <hr class="border-white/40 my-6" />
            <div class="space-y-3">
              <a
                href="{{ route('admin.dashboard') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Dashboard</a
              >
              <a
                href="{{ route('admin.products.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Daftar Produk</a
              >
              <a
                href="{{ route('admin.kategori.index') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Kategori</a
              >
              <a
                href="{{ route('admin.notifikasi') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Notifikasi</a
              >
              <a
                href="{{ route('admin.statistik') }}"
                class="block px-3 py-2 rounded-md hover:bg-white/10 transition"
                >Statistik</a
              >
              <form action="{{ route('admin.logout') }}" method="POST">
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

      <!-- Sidebar Mobile -->
      <div
        class="fixed inset-y-0 left-0 w-64 bg-[#14532D] text-white p-6 z-40 transform transition-transform duration-300 md:hidden"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
      >
        <div class="flex justify-between items-center mb-6">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-10"
          />
        </div>
        <nav class="flex flex-col space-y-3 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/20 my-4" />
          <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200"
            >Dashboard</a
          >
          <a href="{{ route('admin.products.index') }}" class="hover:text-green-200"
            >Daftar Produk</a
          >
          <a href="{{ route('admin.kategori.index') }}" class="hover:text-green-200"
            >Kategori</a
          >
          <a href="{{ route('admin.notifikasi') }}" class="hover:text-green-200"
            >Notifikasi</a
          >
          <a href="{{ route('admin.statistik') }}" class="hover:text-green-200"
            >Statistik</a
          >
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-left hover:text-green-200">
              Logout
            </button>
          </form>
        </nav>
      </div>

      <!-- MAIN CONTENT WRAPPER -->
      <main
        class="flex flex-col items-center justify-start flex-1 px-6 md:px-12 py-8 w-full ml-64"
      >
        <h1 class="text-xl font-semibold text-center mb-1 w-full">
          Daftar Produk
        </h1>

        <p class="text-sm text-center text-black/90 leading-tight mb-6 w-full">
          Admin dapat meninjau setiap produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
        </p>

        <div
          class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-lg shadow-sm mb-6 w-full"
        >
          <!-- Search and Filter Form -->
          <form
            id="filter-form"
            action="{{ route('admin.products.index') }}"
            method="GET"
            class="flex flex-col md:flex-row gap-3 mb-4"
          >
            <!-- Search Input -->
            <div class="relative flex-grow">
              <input
                type="text"
                name="search"
                placeholder="Cari produk..."
                value="{{ request('search') }}"
                onkeypress="handleSearch(event)"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md"
              />
              <span
                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"
              >
                <i class="fas fa-search"></i>
              </span>
            </div>

            <!-- Status Select -->
<div class="relative w-full md:w-32">
  <select
    name="status"
    class="w-full h-[42px] px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10"
  >
    <option value="">Semua</option>
    @foreach($statuses as $status)
      <option
        value="{{ strtolower($status) }}"
        {{ strtolower(request('status')) === strtolower($status) ? 'selected' : '' }}
      >
        {{ $status }}
      </option>
    @endforeach
  </select>
  <img
    src="{{ asset('images/down-arrow.png') }}"
    class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none"
    alt="Dropdown Icon"
  />
</div>


            <!-- Category Select -->
<div class="relative w-full md:w-80">
  <select
    name="category"
    class="w-full h-[42px] px-4 py-2 border border-gray-300 rounded-md bg-white appearance-none pr-10"
  >
    <option value="">Semua Kategori</option>
    @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
        {{ $category->name }}
      </option>

      @if($category->children->isNotEmpty())
        @foreach($category->children as $child)
          <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>
            {{ $category->name }} &gt; {{ $child->name }}
          </option>

          @if($child->children->isNotEmpty())
            @foreach($child->children as $subChild)
              <option value="{{ $subChild->id }}" {{ request('category') == $subChild->id ? 'selected' : '' }}>
                {{ $category->name }} &gt; {{ $child->name }} &gt; {{ $subChild->name }}
              </option>
            @endforeach
          @endif
        @endforeach
      @endif
    @endforeach
  </select>
  <img
    src="{{ asset('images/down-arrow.png') }}"
    class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 pointer-events-none"
    alt="Dropdown Icon"
  />
</div>

          </form>

          <!-- Products Table -->
          <div
            class="bg-white rounded-2xl shadow-lg overflow-auto transition-all hover:shadow-xl w-full"
          >
            <div
              class="grid grid-cols-5 py-4 px-6 text-sm font-semibold text-gray-600 border-b border-gray-100 bg-gray-50 text-center"
            >
              <div class="pl-3 text-left">Produk</div>
              <div>Kategori</div>
              <div>Harga</div>
              <div>Status</div>
              <div>Aksi</div>
            </div>

            @forelse($products as $product)
            <div
              class="product-item grid grid-cols-5 items-center py-4 px-6 border-b border-gray-100 hover:bg-gray-50 transition-colors text-center"
            >
              <div class="flex items-start gap-3 text-left">
                @if($product->first_photo)
                <img
                  src="{{ $product->first_photo->url }}"
                  alt="{{ $product->name }}"
                  class="w-16 h-16 object-cover bg-gray-100 rounded-lg shadow-sm"
                />
                @else
                <div
                  class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center"
                >
                  <i class="fas fa-image text-gray-400 text-xl"></i>
                </div>
                @endif
                <div>
                  <p class="text-blue-600 font-medium mb-1">{{ $product->name }}</p>
                  <p class="text-xs text-gray-500">Variasi :</p>
                  <div class="flex flex-wrap gap-1 mt-1">
                    @if($product->variations->isNotEmpty())
                    @foreach($product->variations as $variation)
                    <span
                      class="px-2 py-1 text-xs bg-purple-100 text-purple-600 rounded-full"
                    >
                      {{ $variation->name }}
                    </span>
                    @endforeach
                    @else
                    <span
                      class="px-2 py-1 text-xs bg-gray-200 text-gray-600 rounded-full"
                    >
                      Tidak Ada
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="text-sm text-gray-600">
                {{ $product->rootCategory ? $product->rootCategory->name : 'Tanpa Kategori' }}
              </div>

              <div class="text-sm font-medium">
                Rp {{ number_format($product->price, 0, ',', '.') }}
              </div>

              <div>
                @php
                $status = ucfirst($product->latestHistory->status ?? 'Diajukan');
                $statusColor = [
                'Diterima' => ['bg' => 'bg-green-500', 'text' => 'text-white'],
                'Ditolak' => ['bg' => 'bg-red-500', 'text' => 'text-white'],
                'Diterima dengan revisi' => ['bg' => 'bg-yellow-500', 'text' => 'text-white'],
                'Diajukan' => ['bg' => 'bg-blue-500', 'text' => 'text-white'],
                ];
                $color = $statusColor[$status] ?? ['bg' => 'bg-gray-500', 'text' => 'text-white'];
                @endphp
                <span
                  class="{{ $color['bg'] }} {{ $color['text'] }} inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-medium min-w-[100px] min-h-[24px] text-center"
                >
                  {{ $status }}
                </span>
              </div>

              <div>
                <a
                  href="{{ route('admin.products.show', $product->id) }}"
                  class="inline-flex items-center gap-2 bg-[#678FAA] hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"
                >
                  <i class="fas fa-eye"></i> Lihat Detail
                </a>
              </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-500">Produk tidak ditemukan.</div>
            @endforelse
          </div>

          <!-- Pagination -->
          @if ($products->hasPages())
          <div class="flex justify-center mt-4 gap-1">
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
            <button
              disabled
              class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-white cursor-not-allowed"
            >
              ‹
            </button>
            @else
            <a
              href="{{ $products->previousPageUrl() }}"
              class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100"
            >
              ‹
            </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($products->getUrlRange(max($products->currentPage() - 2, 1), min($products->currentPage() + 2, $products->lastPage())) as $page => $url)
            @if ($page == $products->currentPage())
            <button
              disabled
              class="w-8 h-8 flex items-center justify-center border border-blue-500 rounded-md text-blue-500 bg-blue-100 cursor-not-allowed"
            >
              {{ $page }}
            </button>
            @else
            <a
              href="{{ $url }}"
              class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100"
            >
              {{ $page }}
            </a>
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
              ›
            </a>
            @else
            <button
              disabled
              class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md text-gray-400 bg-white cursor-not-allowed"
            >
              ›
            </button>
            @endif
          </div>
          @endif
        </div>
      </main>
    </div>

    <script>
      function handleSearch(event) {
        if (event.key === "Enter") {
          event.preventDefault();
          document.getElementById("filter-form").submit();
        }
      }

      function filterCategory(select) {
        if (select.value) {
          window.location.href = select.value;
        }
      }
    </script>

     <!-- Footer -->
      <footer class="bg-[#14532D] text-white py-4 text-center mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} Pemerintahan Kabupaten Bantul. All rights reserved.</p>
      </footer>
  </body>
</html>
