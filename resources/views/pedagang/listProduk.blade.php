<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Daftar Produk
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f7f7f4] min-h-screen flex flex-col">
  <!-- Header -->
  <header class="bg-[#6f92a9] flex items-center px-6 py-4">
   <div class="flex items-center space-x-3">
    <img alt="Logo of Pemerintah Kabupaten Bantul" class="w-10 h-10" height="40" src="https://storage.googleapis.com/a1aa/image/7736693f-e48e-49be-bf3a-480dd13b83cd.jpg" width="40"/>
    <div class="text-white font-semibold text-sm leading-tight">
     <div>
      PEMERINTAH
     </div>
     <div>
      KABUPATEN BANTUL
     </div>
    </div>
   </div>
   <div class="flex-1 text-center">
    <h1 class="text-white font-extrabold text-xl md:text-2xl leading-tight">
     Daftar Produk
    </h1>
    <p class="text-white text-xs md:text-sm max-w-xs mx-auto leading-tight">
     Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat perubahan status secara transparan.
    </p>
   </div>
   <div class="w-40">
   </div>
  </header>
  <div class="flex flex-1">
   <div class="flex flex-1">
    <!-- Sidebar -->
<aside class="bg-[#a9c1d3] w-64 p-6 flex flex-col space-y-6 text-[#555] font-semibold">
  <a href="{{ route('pedagang.profile') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- User Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15c2.486 0 4.779.805 6.879 2.154M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <span>Profile</span>
  </a>

  <a href="{{ route('pedagang.products.index') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Box Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l9 4 9-4M3 12l9 4 9-4" />
    </svg>
    <span>Produk Saya</span>
  </a>

  <a href="{{ route('pedagang.notifikasi') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Bell Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    <span>Notifikasi</span>
  </a>

  <a href="{{ route('pedagang.statistik') }}" class="flex items-center space-x-3 hover:text-blue-700">
    <!-- Chart Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V3h2v8h-2zm-4 4v-4h2v4H7zm8 0v-6h2v6h-2zm4 4v-2H5v2h14z" />
    </svg>
    <span>Statistik</span>
  </a>

  <form action="{{ route('pedagang.logout') }}" method="POST" class="flex items-center space-x-3">
    @csrf
    <button type="submit" class="flex items-center space-x-3 hover:text-red-600">
      <!-- Logout Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h7a1 1 0 011 1v1" />
      </svg>
      <span>Logout</span>
    </button>
  </form>
</aside>

   <!-- Main content -->
   <main class="flex-1 p-8">
    <section class="bg-white rounded-2xl border border-[#6f92a9] shadow-md p-6 max-w-5xl mx-auto">
     <div class="flex justify-between items-center mb-4">
      <h2 class="text-gray-600 font-semibold text-lg">
       Produk Saya
      </h2>
      <button class="bg-[#6f92a9] text-white text-sm font-medium rounded-full px-4 py-1 hover:bg-[#5a7a8f] transition">
       Tambah Produk
      </button>
     </div>
     <div class="border border-[#6f92a9] rounded-xl p-4 space-y-4 text-[#6f92a9]">
      <div class="flex flex-col md:flex-row md:space-x-4 space-y-3 md:space-y-0">
       <div class="flex items-center border border-[#a9c0d4] rounded-md px-3 py-2 w-full md:w-72 text-sm text-[#a9c0d4]">
        <i class="fas fa-search mr-2">
        </i>
        <input class="bg-transparent outline-none w-full placeholder-[#a9c0d4]" placeholder="Cari produk..." type="text"/>
       </div>
       <select class="border border-[#a9c0d4] rounded-md px-3 py-2 text-sm text-[#6f92a9] w-full md:w-32">
        <option>
         Status
        </option>
       </select>
       <select class="border border-[#a9c0d4] rounded-md px-3 py-2 text-sm text-[#6f92a9] w-full md:w-32">
        <option>
         Kategori
        </option>
       </select>
      </div>
      <table class="w-full text-[#6f92a9] text-sm">
       <thead>
        <tr class="border-b border-[#a9c0d4]">
         <th class="text-left font-semibold py-2">
          Produk
         </th>
         <th class="text-left font-semibold py-2">
          Kategori
         </th>
         <th class="text-left font-semibold py-2">
          Harga
         </th>
         <th class="text-left font-semibold py-2">
          Status
         </th>
         <th class="text-left font-semibold py-2">
          Aksi
         </th>
        </tr>
       </thead>
       <tbody>
        <tr class="border-b border-[#a9c0d4] h-12">
        </tr>
        <tr class="border-b border-[#a9c0d4] h-12">
        </tr>
        <tr class="border-b border-[#a9c0d4] h-12">
        </tr>
        <tr class="border-b border-[#a9c0d4] h-12">
        </tr>
        <tr class="border-b border-[#a9c0d4] h-12">
        </tr>
       </tbody>
      </table>
     </div>
     <nav aria-label="Pagination" class="mt-4 flex justify-start items-center space-x-1 text-[#6f92a9] text-xs select-none">
      <button aria-label="Previous page" class="border border-[#a9c0d4] rounded px-2 py-1 disabled:text-[#d1d9e0] disabled:border-[#d1d9e0]" disabled="">
       <i class="fas fa-chevron-left">
       </i>
      </button>
      <button aria-current="page" class="border border-[#a9c0d4] rounded px-2 py-1 bg-[#6f92a9] text-white font-semibold">
       1
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       2
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       3
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       4
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       5
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       6
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       7
      </button>
      <button class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       8
      </button>
      <button aria-label="Next page" class="border border-[#a9c0d4] rounded px-2 py-1 hover:bg-[#d1d9e0]">
       <i class="fas fa-chevron-right">
       </i>
      </button>
     </nav>
    </section>
   </main>
  </div>
  <footer class="bg-[#6f92a9] text-white text-[9px] font-semibold px-6 py-2 select-none">
   <div class="opacity-10">
    © 2025 PemKab Bantul. All Rights Reserved.
   </div>
  </footer>
 </body>
</html>
