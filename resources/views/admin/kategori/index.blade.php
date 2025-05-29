<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Kategori</h1>

        <a href="{{ route('admin.kategori.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
            + Tambah Kategori
        </a>

        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full text-left border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border-b">Nama Kategori</th>
                        <th class="px-4 py-2 border-b">Induk</th>
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $kategori)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $kategori->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $kategori->parent?->name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                            <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus kategori ini?')" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada kategori</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
