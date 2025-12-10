<x-app-layout>
    <div class="bg-gradient-to-r from-green-600 to-teal-500 pb-32 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-white px-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h2>
                    <p class="mt-2 text-green-100 text-lg opacity-90">
                        Terima kasih sudah peduli dengan lingkungan Surabaya.
                    </p>
                </div>
                <div class="mt-4 md:mt-0 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/30 text-sm font-bold shadow-sm">
                    📅 {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 px-4 pb-12">
        
        @if (session('success'))
            <div class="mb-6 bg-white border-l-4 border-green-500 rounded-lg p-4 shadow-lg flex items-center gap-3 animate-fade-in-down">
                <div class="text-green-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Berhasil!</p>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-gray-100 flex flex-col items-center justify-center hover:scale-105 transition transform">
                <span class="text-4xl mb-2">📝</span>
                <span class="text-3xl font-extrabold text-gray-800">{{ $total }}</span>
                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Laporan</span>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-gray-100 flex flex-col items-center justify-center hover:scale-105 transition transform">
                <span class="text-4xl mb-2">⏳</span>
                <span class="text-3xl font-extrabold text-yellow-500">{{ $pending }}</span>
                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Menunggu</span>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-gray-100 flex flex-col items-center justify-center hover:scale-105 transition transform">
                <span class="text-4xl mb-2">⚙️</span>
                <span class="text-3xl font-extrabold text-blue-500">{{ $process }}</span>
                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Diproses</span>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-gray-100 flex flex-col items-center justify-center hover:scale-105 transition transform">
                <span class="text-4xl mb-2">✅</span>
                <span class="text-3xl font-extrabold text-green-500">{{ $completed }}</span>
                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Selesai</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <a href="{{ route('reports.create') }}" class="group relative bg-white rounded-3xl p-8 shadow-md border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:bg-green-100"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-4 text-2xl shadow-sm group-hover:scale-110 transition">
                        📢
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-green-600 transition">Lapor Masalah</h3>
                    <p class="text-gray-500 mt-2 mb-6">
                        Ada sampah menumpuk, jalan berlubang, atau banjir? Jangan diam saja, laporkan sekarang!
                    </p>
                    <div class="inline-flex items-center font-bold text-green-600 group-hover:translate-x-2 transition">
                        Buat Laporan Baru &rarr;
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.index') }}" class="group relative bg-white rounded-3xl p-8 shadow-md border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:bg-blue-100"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-4 text-2xl shadow-sm group-hover:scale-110 transition">
                        📋
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition">Riwayat Laporan</h3>
                    <p class="text-gray-500 mt-2 mb-6">
                        Pantau status laporanmu. Cek apakah sudah ditindaklanjuti oleh petugas dinas terkait.
                    </p>
                    <div class="inline-flex items-center font-bold text-blue-600 group-hover:translate-x-2 transition">
                        Lihat Status &rarr;
                    </div>
                </div>
            </a>

        </div>

        <div class="mt-12 text-center">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} KotaKita Surabaya. Melayani untuk warga.</p>
        </div>

    </div>
</x-app-layout>