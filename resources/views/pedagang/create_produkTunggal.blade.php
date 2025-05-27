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
  <style>
   @import url("https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap");
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f7f7f3] min-h-screen flex flex-col">
  <header class="bg-[#6f95af] flex items-center px-6 py-4">
   <div class="flex items-center space-x-3">
    <img alt="Logo of Pemerintah Kabupaten Bantul, circular emblem with green and yellow colors" class="w-10 h-10" height="40" src="https://storage.googleapis.com/a1aa/image/19071f71-a518-4c07-ec3c-89c40fc439b3.jpg" width="40"/>
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
     Pedagang dapat mengajukan produk yang diajukan serta mencatat riwayat
        perubahan status secara transparan.
    </p>
   </div>
   <div class="w-24">
   </div>
  </header>
  <div class="flex flex-1">
   <nav class="bg-[#a9c0d1] w-56 flex flex-col items-start px-6 py-10 space-y-6">
    <a class="flex items-center space-x-3 text-[#5a6f8a] font-semibold text-base" href="#">
     <i class="fas fa-user fa-lg">
     </i>
     <span>
      Profile
     </span>
    </a>
    <a class="flex items-center space-x-3 text-[#5a6f8a] font-semibold text-base" href="#">
     <img alt="Box icon" class="w-5 h-5" height="20" src="https://storage.googleapis.com/a1aa/image/400783cf-24d4-4b9c-0719-ee4f08a2adcb.jpg" width="20"/>
     <span>
      Produk Saya
     </span>
    </a>
    <a class="flex items-center space-x-3 text-[#5a6f8a] font-semibold text-base" href="#">
     <img alt="Bell icon" class="w-5 h-5" height="20" src="https://storage.googleapis.com/a1aa/image/a717f291-8cdb-486a-d794-0378794168f3.jpg" width="20"/>
     <span>
      Notifikasi
     </span>
    </a>
    <a class="flex items-center space-x-3 text-[#5a6f8a] font-semibold text-base" href="#">
     <img alt="House icon" class="w-5 h-5" height="20" src="https://storage.googleapis.com/a1aa/image/7bc44863-55ca-45f1-f150-06fca087417d.jpg" width="20"/>
     <span>
      Dashboard
     </span>
    </a>
    <a class="flex items-center space-x-3 text-[#5a6f8a] font-semibold text-base" href="#">
     <img alt="Door icon" class="w-5 h-5" height="20" src="https://storage.googleapis.com/a1aa/image/94c17ad9-4532-48a0-b9d9-42aba6e721dd.jpg" width="20"/>
     <span>
      Logout
     </span>
    </a>
   </nav>
   <main class="flex-1 p-8 bg-[#f7f7f3]">
    <section class="bg-white rounded-xl border border-[#6f95af] p-6 max-w-5xl mx-auto shadow-sm">
     <h2 class="text-[#5a5a5a] font-semibold text-lg mb-4">
      Tambah Produk
     </h2>
     <form autocomplete="off" class="bg-white border border-[#6f95af] rounded-xl p-6 flex flex-col md:flex-row md:space-x-8 shadow-md">
      <div class="flex flex-col items-center space-y-4 mb-6 md:mb-0">
       <div class="w-48 h-48 bg-[#e3e3e3] rounded-xl shadow-lg relative flex items-center justify-center">
        <button aria-label="Previous photo" class="absolute left-3 text-[#6f95af] text-2xl font-bold select-none" type="button">
         ‹
        </button>
        <button aria-label="Next photo" class="absolute right-3 text-[#6f95af] text-2xl font-bold select-none" type="button">
         ›
        </button>
       </div>
       <div class="flex space-x-4">
        <div aria-label="Thumbnail photo 1" class="w-20 h-20 bg-[#e3e3e3] rounded-xl shadow-lg">
        </div>
        <div aria-label="Thumbnail photo 2" class="w-20 h-20 bg-[#e3e3e3] rounded-xl shadow-lg">
        </div>
        <div aria-label="Thumbnail photo 3" class="w-20 h-20 bg-[#e3e3e3] rounded-xl shadow-lg">
        </div>
       </div>
       <span class="text-xs text-[#5a5a5a]">
        Upload Foto
       </span>
      </div>
      <div class="flex-1 flex flex-col space-y-4">
       <div>
        <label class="block text-[#5a5a5a] font-semibold text-sm mb-1" for="nama-produk">
         Nama Produk
        </label>
        <input class="w-full bg-[#f7f7f3] border border-transparent focus:border-[#a9c0d1] rounded h-7 text-xs px-2" id="nama-produk" placeholder="" type="text"/>
        <select aria-label="Kategori" class="mt-1 text-xs text-[#6f95af] bg-transparent border border-[#a9c0d1] rounded px-1 py-0.5">
         <option>
          Kategori
         </option>
        </select>
       </div>
       <div>
        <label class="block text-[#5a5a5a] font-semibold text-sm mb-1" for="deskripsi">
         Deskripsi
        </label>
        <textarea class="w-full bg-[#f7f7f3] border border-transparent focus:border-[#a9c0d1] rounded p-2 text-xs resize-none" id="deskripsi" rows="4"></textarea>
       </div>
       <div>
        <label class="block text-[#5a5a5a] font-semibold text-sm mb-1" for="harga">
         Harga
        </label>
        <input class="w-full bg-[#f7f7f3] border border-transparent focus:border-[#a9c0d1] rounded h-7 text-xs px-2" id="harga" placeholder="" type="text"/>
       </div>
       <div>
        <label class="block text-[#5a5a5a] font-semibold text-sm mb-1" for="stok">
         Stok
        </label>
        <input class="w-full bg-[#f7f7f3] border border-transparent focus:border-[#a9c0d1] rounded h-7 text-xs px-2" id="stok" placeholder="" type="text"/>
       </div>
       <div class="flex justify-end">
        <button class="bg-[#6f95af] text-white text-xs rounded-full px-4 py-1" type="submit">
         Upload Produk
        </button>
       </div>
      </div>
     </form>
    </section>
   </main>
  </div>
  <footer class="bg-[#6f95af] h-8 flex items-center justify-center shadow-[0_4px_0_0_rgba(0,0,0,0.15)]">
   <p class="text-white text-[8px] font-semibold opacity-10 select-none">
    © 2025 PemKab Bantul. All Rights Reserved.
   </p>
  </footer>
 </body>
</html>
