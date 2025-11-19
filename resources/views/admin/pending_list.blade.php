<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Daftar Properti Menunggu Review</title>
    {{-- Asumsi Anda menggunakan Vite untuk Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .container { max-width: 1400px; margin: 40px auto; padding: 20px; font-family: sans-serif; }
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 20px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background-color: #3b82f6; color: white; font-weight: bold; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .btn-approve { background-color: #10b981; color: white; padding: 8px 12px; border-radius: 4px; transition: background-color 0.2s; }
        .btn-delete { background-color: #ef4444; color: white; padding: 8px 12px; border-radius: 4px; transition: background-color 0.2s; }
        .btn-submit { background-color: #0d9488; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; }
        .action-btns form, .action-btns a { display: inline-block; margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Daftar Properti Menunggu Persetujuan & Dijual</h1>
        <p class="mb-4 text-center text-gray-600">Anda dapat menyetujui, menghapus, atau mencatat penjualan properti yang sudah disetujui di sini.</p>

        {{-- Pesan Status (Success/Error) --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Properti</th>
                    <th>Marketing</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal Upload</th>
                    <th style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>
                            <a href="{{ route('property.show', $property->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $property->judul }}
                            </a>
                        </td>
                        <td>{{ $property->marketing->name ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($property->harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                @if($property->status === 'pending') bg-yellow-200 text-yellow-800
                                @elseif($property->status === 'approved') bg-green-200 text-green-800
                                @elseif($property->status === 'sold') bg-red-200 text-red-800
                                @else bg-gray-200 text-gray-800
                                @endif">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <td>{{ $property->created_at->format('d/m/Y') }}</td>
                        <td class="action-btns">
                            @if ($property->status === 'pending')
                                {{-- Tombol APPROVE --}}
                                <form method="POST" action="{{ route('admin.approve', $property->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-approve" onclick="return confirm('Yakin ingin menyetujui properti ini?');">Approve</button>
                                </form>
                            @elseif ($property->status === 'approved')
                                {{-- Tombol RECORD SALE --}}
                                <a href="{{ route('admin.transaction.create', $property->id) }}" class="btn-submit">Record Sale</a>
                            @endif
                            
                            {{-- Tombol TOLAK (Hapus) --}}
                            <form method="POST" action="{{ route('admin.delete', $property->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin MENOLAK/MENGHAPUS properti ini?');">Tolak/Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada properti yang menunggu review atau tersedia untuk dijual.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>