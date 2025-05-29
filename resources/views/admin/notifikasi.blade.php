<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifikasi Pedagang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-6">Notifikasi Kamu</h1>

    @if(count($notifikasis) > 0)
        <ul class="space-y-4">
            @foreach($notifikasis as $notifikasi)
                <li class="bg-white p-4 rounded shadow">
                    <p>{{ $notifikasi['pesan'] }}</p>
                    <small class="text-gray-500">Waktu: {{ $notifikasi['waktu'] }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">Belum ada notifikasi.</p>
    @endif

</body>
</html>
