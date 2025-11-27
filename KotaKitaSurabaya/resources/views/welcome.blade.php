<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KotaKita Surabaya</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        /* Fade bawah lebih lembut */
        .bottom-fade {
            mask-image: linear-gradient(to bottom, black 85%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, black 85%, transparent 100%);
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="absolute top-0 left-0 w-full px-8 py-5 flex justify-between items-center z-20">
        <div class="flex items-center gap-3">
            <img src="/images/logo_surabaya.png" class="w-42 h-12 object-contain">
            <span class="text-2xl font-bold text-white tracking-wide drop-shadow">
                KotaKita Surabaya
            </span>
        </div>

        <div class="flex items-center gap-6 text-white font-bold">
            <a href="/login" class="hover:text-white-700 transition">Masuk</a>
            <a href="/register"
               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-md transition">
                Daftar Sekarang
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Background (lebih transparan, lebih jelas) -->
        <img src="/images/sura-baya.jpg"
             class="absolute inset-0 w-full h-full object-cover brightness-[0.90] saturate-[1.1] bottom-fade">

        <!-- Overlay sangat tipis → lebih transparan -->
        <div class="absolute inset-0 bg-black/15 backdrop-blur-[1px]"></div>

        <!-- HERO TEXT -->
        <div class="relative z-10 text-center px-6 max-w-3xl">

            <!-- Tag -->
            <div class="inline-block mb-4 bg-green-500/30 backdrop-blur-md text-white/80 px-4 py-1 rounded-full text-sm shadow-md border border-white/40">
                #SurabayaHebat
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-2xl leading-tight">
                Wujudkan Surabaya
                <span class="text-green-600">Bersih, Aman & Nyaman</span>
            </h1>

            <p class="mt-4 text-lg md:text-xl text-white/95 drop-shadow-lg max-w-2xl mx-auto">
                Laporkan masalah lingkungan di sekitar Anda seperti sampah, banjir,
                atau jalan rusak. Bersama pemerintah kota, mari kita bangun Surabaya yang lebih baik.
            </p>

            <!-- Action Buttons -->
    
    </section>

</body>
</html>
