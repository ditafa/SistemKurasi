<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>statistika Produk - Kurasi Bantul</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body class="h-full bg-[#F8FFF9] text-gray-700 font-sans flex flex-col min-h-screen">

    <!-- Sidebar (selalu tampil di desktop) -->
    <aside class="hidden md:flex md:flex-col md:justify-between md:w-64 md:h-screen fixed bg-[#14532D] text-white p-6">
      <!-- Logo & Navigation -->
      <div>
        <div class="flex items-center justify-between mb-10">
          <img
            src="https://diskominfo.bantulkab.go.id/assets/Site/img/logo-font-white.png"
            alt="Logo"
            class="h-12"
          />
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col space-y-4 text-sm font-medium">
          <a href="/" class="hover:text-green-200">Beranda</a>
          <a href="/about" class="hover:text-green-200">Tentang Kami</a>
          <a href="/kontak" class="hover:text-green-200">Kontak</a>
          <hr class="border-white/40 my-6" />
          <div class="space-y-3">
            <a href="{{ route('pedagang.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Dashboard</a>
            <a href="{{ route('pedagang.produk.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Daftar Produk</a>
            <a href="{{ route('pedagang.notifikasi') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition">Notifikasi</a>
            <a href="{{ route('pedagang.statistik') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition font-bold bg-white/20 rounded-lg">Statistik</a>

            <form action="{{ route('pedagang.logout') }}" method="POST">
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
        <p class="text-sm text-gray-600 max-w-lg mx-auto">
          Statistik ini menyajikan data yang telah terkurasi secara bulanan, memberikan gambaran yang lebih jelas tentang kinerja produk.
        </p>
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
    </main>

    <!-- Footer -->
    <footer class="bg-[#14532D] text-white text-sm py-6 text-center mt-auto">
      <p>© 2025 Kurasi Bantul. Semua hak dilindungi.</p>
    </footer>

    <script>
      // Data dari controller akan di-pass ke view sebagai JSON
      // Contoh data harus di-pass dari controller, disini hanya dummy contoh:
      const bulanLabels = @json($labels); // Contoh: ['Jan', 'Feb', 'Mar', ...]
      const dataDiterima = @json($dataDiterima); // Contoh: [5, 10, 8, ...]
      const dataRevisi = @json($dataRevisi);
      const dataDitolak = @json($dataDitolak);

      const commonOptions = {
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      };

      // Grafik Diterima
      new Chart(document.getElementById('chartDiterima').getContext('2d'), {
        type: 'bar',
        data: {
          labels: bulanLabels,
          datasets: [{
            label: 'Diterima',
            data: dataDiterima,
            backgroundColor: 'rgba(34,197,94,0.7)' // hijau
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
            backgroundColor: 'rgba(202,138,4,0.7)' // kuning tua
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
            backgroundColor: 'rgba(220,38,38,0.7)' // merah
          }]
        },
        options: commonOptions
      });
    </script>

  </body>
</html>
