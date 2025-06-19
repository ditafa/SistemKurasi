<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Statistika Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body class="bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

    <!-- Sidebar -->
    <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6 z-10">
      <div>
        <div class="flex items-center justify-between mb-10">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-12"/>
        </div>
        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6"/>
          <div class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
            <a href="{{ route('admin.kategori.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Kategori</a>
            <a href="{{ route('admin.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition font-semibold bg-white/20 rounded-lg">Statistik</a>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-white/10 transition">Logout</button>
            </form>
          </div>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:ml-64 flex flex-col items-center justify-start min-h-screen">
      <header class="max-w-4xl mb-8 text-center w-full">
        <h1 class="text-4xl font-extrabold text-[#4a8a4a] leading-tight mb-2">STATISTIKA PRODUK</h1>
        <p class="text-sm text-gray-600 max-w-lg mx-auto">Statistik ini menyajikan data yang telah terkurasi secara bulanan, memberikan gambaran yang lebih jelas tentang kinerja produk.</p>
      </header>

      <section class="max-w-4xl border border-[#4a8a4a] rounded-xl p-6 bg-[#e6f0db] shadow-sm w-full">
        <h2 class="font-bold text-lg text-[#5a5a5a] mb-6 text-center">Statistik Produk Per Bulan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <!-- Grafik Diterima -->
          <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold text-center text-green-600 mb-2">Produk Diterima</h3>
            <canvas id="chartDiterima" class="max-h-48"></canvas>
          </div>

          <!-- Grafik Revisi -->
          <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold text-center text-yellow-600 mb-2">Produk Revisi</h3>
            <canvas id="chartRevisi" class="max-h-48"></canvas>
          </div>

          <!-- Grafik Ditolak -->
          <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold text-center text-red-600 mb-2">Produk Ditolak</h3>
            <canvas id="chartDitolak" class="max-h-48"></canvas>
          </div>
        </div>
      </section>

      <!-- Produk yang diajukan oleh pedagang -->
      <section class="max-w-4xl mt-10 w-full">
        <h2 class="font-bold text-lg text-[#5a5a5a] mb-4 text-center">Produk yang Diajukan oleh Pedagang</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow p-4">
          <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
              <tr class="bg-green-100 text-green-800">
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Produk</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Kategori</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Status Kurasi</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Pengajuan</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($produkPedagang as $produk)
                <tr class="hover:bg-green-50">
                  <td class="border border-gray-300 px-4 py-2">{{ $produk->nama_produk }}</td>
                  <td class="border border-gray-300 px-4 py-2">{{ $produk->category->name ?? '-' }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-center">
                    @if ($produk->status_kurasi == 'diterima')
                      <span class="text-green-600 font-semibold">Diterima</span>
                    @elseif ($produk->status_kurasi == 'revisi')
                      <span class="text-yellow-600 font-semibold">Revisi</span>
                    @elseif ($produk->status_kurasi == 'ditolak')
                      <span class="text-red-600 font-semibold">Ditolak</span>
                    @else
                      <span class="text-gray-600">Menunggu</span>
                    @endif
                  </td>
                  <td class="border border-gray-300 px-4 py-2 text-center">{{ $produk->created_at->format('d M Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="border border-gray-300 px-4 py-6 text-center text-gray-500 italic">Belum ada produk yang diajukan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <footer class="bg-[#14532D] text-white text-sm py-6 text-center mt-auto md:ml-64">
      <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
    </footer>

    <!-- Chart.js Rendering -->
    <script>
      const bulanLabels = @json($labels);
      const dataDiterima = @json($dataDiterima);
      const dataRevisi = @json($dataRevisi);
      const dataDitolak = @json($dataDitolak);

      const commonOptions = {
        maintainAspectRatio: false,
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: { legend: { display: false } }
      };

      // Grafik Diterima
      new Chart(document.getElementById('chartDiterima').getContext('2d'), {
        type: 'bar',
        data: {
          labels: bulanLabels,
          datasets: [{
            label: 'Diterima',
            data: dataDiterima,
            backgroundColor: 'rgba(34,197,94,0.7)'
          }]
        },
        options: commonOptions
      });

      // Grafik Revisi
      new Chart(document.getElementById('chartRevisi').getContext('2d'), {
        type: 'bar',
        data: {
          labels: bulanLabels,
          datasets: [{
            label: 'Revisi',
            data: dataRevisi,
            backgroundColor: 'rgba(202,138,4,0.7)'
          }]
        },
        options: commonOptions
      });

      // Grafik Ditolak
      new Chart(document.getElementById('chartDitolak').getContext('2d'), {
        type: 'bar',
        data: {
          labels: bulanLabels,
          datasets: [{
            label: 'Ditolak',
            data: dataDitolak,
            backgroundColor: 'rgba(220,38,38,0.7)'
          }]
        },
        options: commonOptions
      });
    </script>

  </body>
</html>
