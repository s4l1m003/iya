{{-- resources/views/home.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Properti - Sudah Jalan!</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: green; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎉 Katalog Properti Berhasil Diakses! 🎉</h1>
        <p>Halaman utama sudah ditemukan.</p>

        @if ($properties->isEmpty())
            <p>Belum ada properti yang di-approve atau data belum di-seed.</p>
        @else
            <p>Ada {{ $properties->count() }} properti yang ditemukan dan siap ditampilkan.</p>
            {{-- Di sini tempat Anda menampilkan properti menggunakan @include('components._property_card') --}}
        @endif
    </div>
</body>
</html>