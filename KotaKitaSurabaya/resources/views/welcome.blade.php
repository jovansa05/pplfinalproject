<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KotaKita - Surabaya</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased font-sans text-gray-900">

    <nav class="absolute top-0 w-full z-20 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center"> <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo_surabaya.png') }}" 
                         alt="Logo Surabaya" 
                         class="h-14 w-auto object-contain drop-shadow-lg filter brightness-110">
                    
                    <span class="font-bold text-2xl tracking-wide text-white drop-shadow-md">
                        KotaKita Surabaya
                    </span>
                </div>

                <div class="hidden sm:flex space-x-4 items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-bold text-green-700 bg-white rounded-full hover:bg-gray-100 transition shadow-lg flex items-center gap-2">
                                <span>Masuk Dashboard</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-base font-semibold text-white hover:text-green-300 transition drop-shadow-md px-4">
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 text-base font-bold text-white bg-green-600 rounded-full hover:bg-green-500 transition shadow-lg border-2 border-green-500 hover:border-green-400">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative h-screen flex items-center justify-center bg-cover bg-center bg-fixed" 
             style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mt-10">
            
            <span class="inline-block py-1 px-3 rounded-full bg-green-500/20 border border-green-400 text-green-300 text-sm font-semibold mb-6 backdrop-blur-sm">
                #SurabayaHebat
            </span>

            <h1 class="text-5xl sm:text-7xl font-extrabold text-white mb-6 tracking-tight drop-shadow-lg leading-tight">
                Wujudkan Surabaya <br> 
                <span class="text-green-400">Bersih, Aman & Nyaman</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-100 mb-10 max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                Laporkan masalah lingkungan di sekitarmu seperti sampah, banjir, atau jalan rusak. 
                Bersama pemerintah kota, mari kita bangun Surabaya yang lebih baik.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-green-600 text-white font-bold rounded-full shadow-xl hover:bg-green-500 transition transform hover:-translate-y-1 ring-4 ring-green-600/30">
                    Lapor Masalah Sekarang
                </a>
                <a href="#cara-kerja" class="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-full shadow-lg border border-white/30 hover:bg-white/20 transition">
                    Pelajari Cara Kerja
                </a>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-gray-900">Alur Pelaporan</h2>
                <p class="text-gray-500 mt-4 text-lg">Laporkan masalah hanya dalam 3 langkah mudah</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold group-hover:bg-green-600 group-hover:text-white transition">1</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Tulis Laporan</h3>
                    <p class="text-gray-600 leading-relaxed">Foto masalahnya, tentukan lokasinya (GPS), dan kirim laporan Anda.</p>
                </div>

                <div class="p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group">
                    <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold group-hover:bg-blue-600 group-hover:text-white transition">2</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Verifikasi & Proses</h3>
                    <p class="text-gray-600 leading-relaxed">Admin Pemkot akan memverifikasi dan meneruskannya ke dinas terkait.</p>
                </div>

                <div class="p-8 bg-white rounded-2xl border border-gray-100 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group">
                    <div class="w-20 h-20 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl font-bold group-hover:bg-yellow-500 group-hover:text-white transition">3</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">Selesai & Rating</h3>
                    <p class="text-gray-600 leading-relaxed">Masalah beres! Anda dapat notifikasi email dan bisa memberi rating.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-white/10 p-2 rounded-lg">
                    <img src="{{ asset('images/logo_surabaya.png') }}" class="h-8 w-auto">
                </div>
                <span class="text-xl font-bold tracking-tight">KotaKita Surabaya</span>
            </div>
            <div class="text-center md:text-right text-gray-400 text-sm">
                <p>&copy; 2025 Kelompok 3 Sistem Informasi - Telkom University.</p>
                <p class="mt-1">Dibuat untuk Kota Pahlawan.</p>
            </div>
        </div>
    </footer>

</body>
</html>