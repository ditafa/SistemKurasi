<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pedagang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 p-8">

    <h1 class="text-2xl font-bold mb-6">Daftar Pedagang</h1>

    <a href="{{ route('admin.pendaftaran.create') }}" class="inline-block bg-green-700 text-white px-4 py-2 mb-4 rounded hover:bg-green-800">
    + Tambah Pedagang
</a>

    <table class="min-w-full bg-white border border-gray-300 shadow">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedagang as $user)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border">{{ $user->nama }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
