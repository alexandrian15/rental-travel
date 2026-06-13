<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Travel</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">

        <h1 class="text-xl font-bold mb-4 text-gray-700">
            Cari Tiket Travel
        </h1>

        <form method="POST" action="{{ route('travel.search') }}" class="space-y-4">
            @csrf

            <input type="text" name="asal" placeholder="Kota Asal"
                   class="w-full border p-2 rounded">

            <input type="text" name="tujuan" placeholder="Kota Tujuan"
                   class="w-full border p-2 rounded">

            <input type="date" name="tanggal"
                   class="w-full border p-2 rounded">

            <button class="w-full bg-blue-600 text-white p-2 rounded">
                Cari
            </button>

        </form>

    </div>

</body>
</html>