<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Profile Pedagang
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Poppins", sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f7f7f4] min-h-screen flex flex-col">
  <header class="bg-[#6f92a9] flex items-center px-6 py-4 shadow-md">
   <div class="flex items-center space-x-3">
    <img alt="Government emblem logo with yellow and green colors" class="w-12 h-12" height="48" src="https://storage.googleapis.com/a1aa/image/d36c0b64-1b8a-443b-b384-698b81f0950d.jpg" width="48"/>
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
     Profile Pedagang
    </h1>
    <p class="text-white text-xs md:text-sm max-w-md mx-auto leading-tight">
     Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat
        perubahan status secara transparan.
    </p>
   </div>
   <div class="w-12">
   </div>
  </header>

  <div class="flex flex-1">
  <!-- Sidebar -->
  <aside class="bg-[#a9c1d3] w-64 p-6 flex flex-col space-y-6 text-[#555] font-semibold">
    <a href="{{ route('pedagang.dashbord') }}" class="flex items-center space-x-3 hover:text-blue-700">
      <!-- Home / Dashboard Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
      </svg>
      <span>Dashboard</span>
    </a>

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
   
   <main class="flex-1 p-8">
    <section class="bg-white rounded-xl border border-[#6f92a9] p-6 shadow-md max-w-5xl mx-auto">
     <h2 class="text-[#4a4a4a] font-bold text-lg mb-4">
      Profile
     </h2>
     <form autocomplete="off" class="bg-white rounded-lg border border-[#6f92a9] p-6 shadow-inner grid grid-cols-1 md:grid-cols-[auto_1fr] gap-x-8 gap-y-6 items-center">
      <div class="flex flex-col items-center space-y-2">
       <div aria-label="Square placeholder for profile photo upload with subtle shadow" class="w-24 h-24 rounded-xl bg-[#f7f3f3] shadow-lg">
       </div>
       <span class="text-xs text-gray-500">
        Upload Foto
       </span>
      </div>
      <div class="space-y-4 w-full">
       <div class="flex items-center">
        <label class="w-28 text-sm font-normal text-black" for="nama">
         Nama Lengkap
        </label>
        <input class="flex-1 bg-[#f7f7f7] h-8 rounded-sm px-3 text-sm border border-transparent focus:outline-none focus:ring-1 focus:ring-[#6f92a9]" id="nama" type="text"/>
       </div>
       <div class="flex items-center">
        <label class="w-28 text-sm font-normal text-black" for="email">
         Email
        </label>
        <input class="flex-1 bg-[#f7f7f7] h-8 rounded-sm px-3 text-sm border border-transparent focus:outline-none focus:ring-1 focus:ring-[#6f92a9]" id="email" type="email"/>
       </div>
       <div class="flex items-center">
        <label class="w-28 text-sm font-normal text-black" for="hp">
         Nomor HP
        </label>
        <input class="flex-1 bg-[#f7f7f7] h-8 rounded-sm px-3 text-sm border border-transparent focus:outline-none focus:ring-1 focus:ring-[#6f92a9]" id="hp" type="tel"/>
       </div>
       <div class="flex items-center">
        <label class="w-28 text-sm font-normal text-black" for="alamat">
         Alamat
        </label>
        <input class="flex-1 bg-[#f7f7f7] h-8 rounded-sm px-3 text-sm border border-transparent focus:outline-none focus:ring-1 focus:ring-[#6f92a9]" id="alamat" type="text"/>
       </div>
       <div class="flex justify-end space-x-6 pt-2">
        <button class="bg-[#6f92a9] text-white text-xs rounded-full px-3 py-1" type="button">
         Edit Profile
        </button>
        <button class="bg-[#6f92a9] text-white text-xs rounded-full px-3 py-1" type="submit">
         Simpan
        </button>
       </div>
      </div>
     </form>
    </section>
   </main>
  </div>


  <footer class="bg-[#6f92a9] text-white text-[9px] font-extrabold px-6 py-2 select-none shadow-inner">
   <p>
    © 2025 PemKab Bantul. All Rights Reserved.
   </p>
  </footer>
 </body>
</html>
