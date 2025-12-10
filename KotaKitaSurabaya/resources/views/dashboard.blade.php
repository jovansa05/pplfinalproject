<x-app-layout>
    <div class="relative pb-32 pt-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/auth-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-teal-800/80"></div>

        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-white px-4">
                
                <div class="flex items-center gap-4">
                    <div class="p-1 bg-white/20 rounded-full backdrop-blur-md">
                        <img class="h-16 w-16 rounded-full border-2 border-white shadow-md object-cover" 
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" 
                             alt="User Avatar">
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-white drop-shadow-md">
                            Hai, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                        </h2>
                        <p class="text-green-100 text-lg font-medium opacity-90">
                            Mau laporin apa hari ini?
                        </p>
                    </div>
                </div>

                <div class="mt-6 md:mt-0 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3 text-right shadow-lg">
                    <p class="text-xs text-green-200 uppercase tracking-widest font-bold">Hari ini</p>
                    <p class="text-xl font-bold text-white">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 px-4 pb-12 relative z-20">
        
        @if (session('success'))
            <div class="mb-6 bg-white border-l-4 border-green-500 rounded-xl p-4 shadow-lg flex items-center gap-3 animate-fade-in-down">
                <div class="bg-green-100 p-2 rounded-full text-green-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Berhasil!</p>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-gray-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total</p>
                        <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $total }}</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded-lg text-2xl">📝</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-yellow-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Menunggu</p>
                        <p class="text-3xl font-extrabold text-yellow-500 mt-1">{{ $pending }}</p>
                    </div>
                    <div class="p-2 bg-yellow-50 rounded-lg text-2xl">⏳</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-blue-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Diproses</p>
                        <p class="text-3xl font-extrabold text-blue-500 mt-1">{{ $process }}</p>
                    </div>
                    <div class="p-2 bg-blue-50 rounded-lg text-2xl">⚙️</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-green-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Selesai</p>
                        <p class="text-3xl font-extrabold text-green-500 mt-1">{{ $completed }}</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-lg text-2xl">✅</div>
                </div>
            </div>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            Akses Cepat 🚀
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <a href="{{ route('reports.create') }}" class="relative overflow-hidden bg-white rounded-3xl p-8 shadow-md border border-gray-100 hover:shadow-2xl hover:border-green-200 transition duration-300 group">
                <div class="absolute right-0 top-0 w-64 h-64 bg-green-50 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-green-100 transition"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-green-600 text-white rounded-2xl flex items-center justify-center mb-6 text-2xl shadow-lg shadow-green-200 group-hover:scale-110 transition">
                        📢
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-green-700 transition">Lapor Masalah</h3>
                    <p class="text-gray-500 mt-3 mb-8 leading-relaxed">
                        Temukan jalan rusak, sampah menumpuk, atau fasilitas umum yang rusak? Foto dan laporkan sekarang juga.
                    </p>
                    <div class="mt-auto flex items-center font-bold text-green-600 group-hover:translate-x-2 transition">
                        Buat Laporan Baru &rarr;
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.index') }}" class="relative overflow-hidden bg-white rounded-3xl p-8 shadow-md border border-gray-100 hover:shadow-2xl hover:border-blue-200 transition duration-300 group">
                <div class="absolute right-0 top-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-blue-100 transition"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 text-2xl shadow-lg shadow-blue-200 group-hover:scale-110 transition">
                        📋
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-700 transition">Riwayat Laporan</h3>
                    <p class="text-gray-500 mt-3 mb-8 leading-relaxed">
                        Cek status laporanmu apakah sudah diproses atau selesai. Lihat respon dan bukti pengerjaan dari petugas.
                    </p>
                    <div class="mt-auto flex items-center font-bold text-blue-600 group-hover:translate-x-2 transition">
                        Lihat Status &rarr;
                    </div>
                </div>
            </a>

        </div>

        <div class="mt-16 text-center border-t border-gray-100 pt-8">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} KotaKita Surabaya. Dikembangkan dengan semangat 🐊
            </p>
        </div>

    </div>
</x-app-layout>