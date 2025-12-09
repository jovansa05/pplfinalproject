<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 relative border border-gray-100">
                <div class="p-8 text-gray-900 z-10 relative">
                    <h3 class="text-3xl font-extrabold text-gray-900">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-600 mt-2 text-lg max-w-2xl">
                        Selamat datang kembali. Mari berkontribusi menjadikan Surabaya lebih bersih, aman, dan nyaman.
                    </p>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-green-50 to-transparent opacity-50"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition duration-300 group flex flex-col h-full">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Lapor Masalah</h4>
                    <p class="text-gray-500 mb-8 leading-relaxed flex-1">
                        Temukan sampah menumpuk, jalan rusak, atau banjir? Laporkan segera di sini agar tim terkait bisa menanganinya.
                    </p>
                    <a href="{{ route('reports.create') }}" class="block w-full py-4 bg-green-600 text-white font-bold text-center rounded-xl hover:bg-green-700 transition shadow-md">
                        + Buat Laporan Baru
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition duration-300 group flex flex-col h-full">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Riwayat Laporan</h4>
                    <p class="text-gray-500 mb-8 leading-relaxed flex-1">
                        Pantau terus status laporanmu. Lihat respon admin, bukti penanganan, dan berikan rating kepuasan.
                    </p>
                    <a href="{{ route('reports.index') }}" class="block w-full py-4 bg-white border-2 border-blue-600 text-blue-600 font-bold text-center rounded-xl hover:bg-blue-50 transition">
                        Lihat Status Laporan
                    </a>
                </div>

            </div>

            <div class="mt-10 text-center text-gray-400 text-sm">
                &copy; 2025 KotaKita Surabaya. Melayani dengan hati.
            </div>

        </div>
    </div>
</x-app-layout>
