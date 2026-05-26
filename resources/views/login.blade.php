<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-purple-50 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-sm border-4 border-purple-200">
        <h2 class="text-2xl font-bold text-purple-400 mb-6 text-center">Selamat Datang ✨</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-600 p-3 rounded-xl mb-4 text-center text-sm font-medium border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded-xl mb-4 text-center text-sm font-medium border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-purple-400 font-bold mb-1 ml-1 text-sm">Email</label>
                <input type="email" name="email" placeholder="Masukkan email anda" 
                    class="w-full border-2 border-purple-100 rounded-xl p-3 focus:outline-none focus:border-purple-300 transition" required>
            </div>
            
            <div>
                <label class="block text-purple-400 font-bold mb-1 ml-1 text-sm">Password</label>
                <input type="password" name="password" placeholder="Masukkan password anda" 
                    class="w-full border-2 border-purple-100 rounded-xl p-3 focus:outline-none focus:border-purple-300 transition" required>
            </div>

            <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-xl hover:bg-purple-500 transition shadow-md transform active:scale-95 mt-2">
                Masuk Sekarang ✨
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-400 text-sm">
                Belum punya akun? 
                <a href="/register" class="text-purple-400 font-bold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</body>
</html>