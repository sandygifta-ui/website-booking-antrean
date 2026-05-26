<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin ✨</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi indikator Live */
        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .animate-live { animation: pulse-soft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        
        /* Efek baris tabel digeser saat hover */
        .table-row-hover:hover { transform: translateX(8px); }
    </style>
</head>
<body class="bg-[#FAF9F6] min-h-screen p-6 font-sans">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center bg-white p-8 rounded-[2rem] shadow-sm border border-orange-50 mb-10 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-50 rounded-full opacity-50"></div>
            
            <div class="relative z-10">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Reservasi 📜</h1>
                <p class="text-gray-400 text-sm mt-1 flex items-center">
                    Kontrol akses: <span class="text-orange-400 font-bold ml-1">{{ Auth::user()->name }}</span>
                    <span class="mx-2 text-gray-200">|</span>
                    <span id="clock" class="text-gray-500 font-mono italic"></span>
                </p>
            </div>
            
            <form action="/logout" method="POST" class="relative z-10">
                @csrf
                <button type="submit" class="bg-gray-50 text-gray-400 px-6 py-2 rounded-xl hover:bg-red-50 hover:text-red-400 transition-all active:scale-95 font-bold text-xs tracking-widest border border-gray-100 shadow-sm">
                    LOGOUT
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-6 text-center text-sm font-medium border border-emerald-100 shadow-sm animate-bounce">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
                <h3 class="font-bold text-gray-700 flex items-center">
                    Daftar Masuk 
                    <span class="ml-2 w-2 h-2 bg-emerald-400 rounded-full"></span>
                </h3>
                <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter animate-live border border-emerald-100">
                    Live Updates
                </span>
            </div>

            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr class="text-gray-400 text-[11px] uppercase tracking-widest">
                        <th class="p-6 font-bold">Pelanggan</th>
                        <th class="p-6 font-bold">Kontak</th>
                        <th class="p-6 font-bold">Meja</th>
                        <th class="p-6 font-bold text-center">Jadwal</th>
                        <th class="p-6 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reservations as $row)
                    <tr class="table-row-hover transition-all duration-300 group hover:bg-orange-50/20">
                        <td class="p-6">
                            <div class="font-bold text-gray-700 group-hover:text-orange-500 transition-colors">{{ $row->customer_name }}</div>
                            <div class="text-[10px] text-gray-400 font-mono tracking-tighter">REF: #{{ $row->id }}00{{ $loop->iteration }}</div>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 font-medium text-sm">{{ $row->phone_number }}</span>
                                <a href="https://wa.me/{{ $row->phone_number }}" target="_blank" class="opacity-0 group-hover:opacity-100 transition-opacity text-[10px] bg-green-100 text-green-600 px-2 py-0.5 rounded-md font-bold">WA</a>
                            </div>
                        </td>
                        <td class="p-6">
                            <span class="bg-orange-50 text-orange-500 px-4 py-1.5 rounded-xl text-xs font-bold border border-orange-100 group-hover:bg-white transition-all shadow-sm">
                                {{ $row->table->name ?? 'Meja Terhapus' }}
                            </span>
                        </td>
                        <td class="p-6 text-center">
                            <div class="text-sm font-bold text-gray-600">{{ $row->reservation_date }}</div>
                            <div class="text-[11px] text-gray-400 italic">{{ $row->reservation_time }} WIB</div>
                        </td>
                        <td class="p-6 text-center">
                            <form action="/admin/reservations/{{ $row->id }}" method="POST" onsubmit="return confirm('Selesaikan reservasi untuk {{ $row->customer_name }}? 🌸')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white flex items-center justify-center border border-emerald-100 shadow-sm transition-all transform active:scale-90 hover:rotate-6 mx-auto" title="Check-in Hadir">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <span class="text-4xl text-gray-200 text-center block">☕</span>
                                <p class="text-gray-400 italic text-sm">Belum ada tamu yang booking meja hari ini...</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <p class="text-center mt-10 text-gray-300 text-[10px] uppercase tracking-[0.2em] font-bold">Sistem Manajemen Restoran v1.2 ✨</p>
    </div>

    <script>
        // Script Jam Digital
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('clock').textContent = time + " WIB";
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>