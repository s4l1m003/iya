<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Selamat Datang - Katalog Properti</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-gray-800 text-white px-6 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold">Logo</a>
            <div class="space-x-4">
                <a href="{{ route('properties.index') }}" class="hover:underline">Daftar Properti</a>
                @guest
                    <a href="{{ route('login') }}" class="px-3 py-1 bg-indigo-600 rounded">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-1 border rounded">Register</a>
                @else
                    <span>Hi, {{ auth()->user()->name }}</span>
                    <form class="inline" action="{{ route('logout') }}" method="POST">@csrf<button class="px-3 py-1 bg-red-600 rounded">Logout</button></form>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-16">
        <div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow text-center">
            <img src="https://img.icons8.com/emoji/96/000000/house-emoji.png" alt="logo" class="mx-auto mb-4">
            <h1 class="text-3xl font-extrabold mb-2">Selamat Datang di Aplikasi Katalog Properti</h1>
            <p class="text-gray-600 mb-6">
                Lihat daftar properti yang tersedia atau masuk untuk mengelola data.
                Sistem mendukung peran: admin, marketing, pajak, ketua, dan pelanggan.
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('properties.index') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg">Lihat Properti</a>
                <a href="{{ route('login') }}" class="px-6 py-3 border rounded-lg">Login / Register</a>
            </div>

            <div class="mt-6 text-left text-sm text-gray-500">
                <strong>Apa yang bisa dilakukan tiap peran:</strong>
                <ul class="list-disc ml-6 mt-2">
                    <li>Marketing: Upload properti (judul, deskripsi, harga, alamat, luas, gambar)</li>
                    <li>Admin: Approve/reject upload; tandai sold; hubungkan pelanggan ke marketing</li>
                    <li>Pajak: Lihat laporan penjualan dan hitung pajak (mis. 12%)</li>
                    <li>Ketua: Lihat ringkasan properti yang terjual</li>
                    <li>Pelanggan: Lihat detail properti dan kirim permintaan kontak ke marketing</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>