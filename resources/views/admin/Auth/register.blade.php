<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Sistem Properti</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-2xl">
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
            Buat Akun Baru
        </h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            {{-- Bidang Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bidang Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bidang Role (Penting untuk aplikasi Anda) --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                <select id="role" name="role" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="marketing" {{ old('role') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bidang Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input id="password" type="password" name="password" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bidang Confirm Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Register --}}
            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Daftar
                </button>
            </div>
        </form>

        {{-- Link ke Login --}}
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</body>
</html>