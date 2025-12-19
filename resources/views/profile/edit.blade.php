<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Edit Profil</title></head>
<body>
    <h1>Edit Profil</h1>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" style="margin-top:20px;">
        @csrf
        @method('DELETE')
        <input type="password" name="password" placeholder="Masukkan password untuk hapus akun" required>
        <button type="submit" style="background:red;color:#fff;">Hapus Akun</button>
    </form>
</body>
</html>