<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-sm border-4 border-blue-200">
        <h2 class="text-2xl font-bold text-blue-400 mb-6 text-center">Buat Akun Tamu ✨</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-xl mb-4 text-xs font-medium border border-red-100">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-blue-400 font-bold mb-1 ml-1 text-sm">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap" class="w-full border-2 border-blue-100 rounded-xl p-3 focus:outline-none focus:border-blue-300 transition" value="{{ old('name') }}" required>
            </div>
            
            <div>
                <label class="block text-blue-400 font-bold mb-1 ml-1 text-sm">Email</label>
                <input type="email" name="email" placeholder="Masukkan alamat email" class="w-full border-2 border-blue-100 rounded-xl p-3 focus:outline-none focus:border-blue-300 transition" value="{{ old('email') }}" required>
            </div>
            
            <div>
                <label class="block text-blue-400 font-bold mb-1 ml-1 text-sm">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full border-2 border-blue-100 rounded-xl p-3 focus:outline-none focus:border-blue-300 transition" required>
            </div>
            
            <div>
                <label class="block text-blue-400 font-bold mb-1 ml-1 text-sm">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password anda" class="w-full border-2 border-blue-100 rounded-xl p-3 focus:outline-none focus:border-blue-300 transition" required>
            </div>

            <button type="submit" class="w-full bg-blue-400 text-white font-bold py-3 rounded-xl hover:bg-blue-500 transition shadow-md transform active:scale-95 mt-2">
                Daftar Sekarang ✨
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-400 text-sm">
                Sudah punya akun? 
                <a href="/login" class="text-blue-400 font-bold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>