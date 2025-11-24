<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Aplikasi Properti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb; /* Latar belakang sangat terang */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-xl bg-white p-10 rounded-xl shadow-3xl border border-gray-200 text-center">
        
        <div class="text-6xl mb-4">🏠</div>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Aplikasi Katalog Properti</h1>
        <p class="text-lg text-gray-600 mb-8">
            Selamat datang! Ini adalah halaman utama publik. Untuk mengelola data atau mengakses dashboard, silakan masuk ke sistem.
        </p>
        
        <!-- Tombol Menuju Halaman Login -->
        <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 py-3 px-8 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition duration-300 transform hover:scale-[1.02]">
             <!-- Icon Masuk (Lucide) -->
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
             <span>Masuk ke Dashboard</span>
        </a>

        <p class="mt-8 text-sm text-gray-400">
            Anda akan diarahkan ke halaman **halaman_masuk.blade.php**
        </p>
    </div>

</body>
</html>