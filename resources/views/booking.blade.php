<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Restoran ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#EBF3FC] to-[#FFF9E6] p-6 min-h-screen font-sans">
    <div class="max-w-md mx-auto">
        
        <div class="flex justify-between items-center mb-8 bg-white/70 backdrop-blur-sm p-4 rounded-2xl border border-blue-100 shadow-sm">
            <p class="text-blue-600 font-medium text-sm">Selamat Datang, <span class="font-bold text-amber-600">{{ Auth::user()->name }}</span> ✨</p>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="text-xs font-bold bg-amber-100 text-amber-700 px-3 py-1.5 rounded-xl hover:bg-red-100 hover:text-red-600 transition">LOGOUT</button>
            </form>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-blue-100/40 border-4 border-amber-50/60">
            <h2 class="text-2xl font-bold text-gray-700 mb-1 text-center">Buat Reservasi</h2>
            <p class="text-gray-400 text-xs text-center mb-8">Silakan lengkapi data kunjungan Anda di bawah ini</p>

            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-6 text-center text-sm font-medium border border-emerald-100">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/booking" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-gray-600 font-semibold mb-2 ml-1 text-sm">Nama Lengkap Pelanggan</label>
                    <input type="text" name="customer_name" value="{{ Auth::user()->name }}" placeholder="Masukkan nama lengkap" class="w-full border border-gray-100 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-blue-200 focus:bg-white outline-none transition text-gray-700 font-medium" required>
                </div>

                <div>
                    <label class="block text-gray-600 font-semibold mb-2 ml-1 text-sm">Nomor Telepon / WhatsApp</label>
                    <input type="tel" name="phone_number" placeholder="Contoh: 081234567xxx" class="w-full border border-gray-100 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-amber-200 focus:bg-white outline-none transition text-gray-700 font-medium" required>
                </div>
                
                <div>
                    <label class="block text-gray-600 font-semibold mb-2 ml-1 text-sm">Pilih Meja Restoran</label>
                    <select name="table_id" class="w-full border border-gray-100 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-blue-200 focus:bg-white outline-none transition text-gray-600 font-medium">
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }} (Kapasitas {{ $table->capacity }} Orang)</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-semibold mb-2 ml-1 text-sm">Tanggal</label>
                        <input type="date" name="reservation_date" class="w-full border border-gray-100 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-blue-100 focus:bg-white outline-none transition text-gray-600" required>
                    </div>
                    <div>
                        <label class="block text-gray-600 font-semibold mb-2 ml-1 text-sm">Waktu Jam</label>
                        <input type="time" name="reservation_time" class="w-full border border-gray-100 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-blue-100 focus:bg-white outline-none transition text-gray-600" required>
                    </div>
                </div>

                <input type="hidden" name="guest_count" value="1">

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-amber-400 text-white font-bold py-4 rounded-2xl hover:opacity-90 shadow-lg shadow-blue-100 transition-all transform active:scale-95 mt-4">
                    Konfirmasi Pesanan Meja ✨
                </button>
            </form>
        </div>
    </div>
</body>
</html>