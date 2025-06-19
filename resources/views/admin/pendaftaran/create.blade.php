<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pedagang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 p-8">

    <h1 class="text-2xl font-bold mb-6">Form Tambah Pedagang</h1>

    <form action="{{ route('admin.pendaftaran.store') }}" method="POST" class="max-w-md bg-white p-6 rounded-lg shadow">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>
        </div>

        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
            Simpan Pedagang
        </button>
    </form>

</body>
</html>
