<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KotaKita Surabaya</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('/images/sura-baya.jpg');">

    <!-- Overlay lebih terang & fresh -->
    <div class="absolute inset-1 bg-white/1 backdrop-blur-[2px]"></div>

    <div class="relative z-10 flex justify-center items-center min-h-screen px-4">
        <div class="bg-white/30 backdrop-blur-xl rounded-3xl p-8 w-full max-w-sm
            border border-white/40 shadow-[0_4px_20px_rgba(0,0,0,0.15)] transition-all duration-300">

            <!-- Logo dan Judul -->
            <div class="text-center mb-6">
                <img src="/images/logo_surabaya.png" alt="Logo Surabaya"
                     class="mx-auto w-28 h-28 object-contain mb-3 drop-shadow-md">
                <h2 class="text-3xl font-extrabold text-green-600 drop-shadow-sm tracking-wide">
                    KotaKita Surabaya
                </h2>
                <p class="text-green-700/90 text-sm font-medium">
                    Ayo bersama menjaga lingkungan 🌱
                </p>
            </div>

            <form action="/register" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-green-900 font-semibold text-sm">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900 
                               focus:ring-2 focus:ring-green-500 placeholder-gray-600 border-0 shadow-sm">
                </div>

                <div>
                    <label class="block text-green-900 font-semibold text-sm">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900 
                               focus:ring-2 focus:ring-green-500 placeholder-gray-600 border-0 shadow-sm">
                </div>

                <div>
                    <label class="block text-green-900 font-semibold text-sm">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900
                               focus:ring-2 focus:ring-green-500 placeholder-gray-600 border-0 shadow-sm">
                </div>

                <div>
                    <label class="block text-green-900 font-semibold text-sm">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900
                               focus:ring-2 focus:ring-green-500 placeholder-gray-600 border-0 shadow-sm">
                </div>

                <!-- Kecamatan & Kelurahan -->
                <div class="flex gap-3">
                    <div class="flex-1">
                        <label class="block text-green-900 font-semibold text-sm">Kecamatan</label>
                        <select name="kecamatan" required
                            class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900 
                                   focus:ring-2 focus:ring-green-500 border-0 shadow-sm">
                            <option>Pilih</option>
                            <option>Wonokromo</option>
                            <option>Tegalsari</option>
                            <option>Genteng</option>
                            <option>Rungkut</option>
                            <option>Sukolilo</option>
                            <option>Tambaksari</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-green-900 font-semibold text-sm">Kelurahan</label>
                        <select name="kelurahan" required
                            class="w-full mt-1 p-2 rounded-xl bg-white/85 text-gray-900
                                   focus:ring-2 focus:ring-green-500 border-0 shadow-sm">
                            <option>Pilih</option>
                            <option>Wonokromo</option>
                            <option>Keputih</option>
                            <option>Kali Rungkut</option>
                            <option>Pacarkeling</option>
                            <option>Kapasan</option>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <button class="w-full py-3 rounded-xl bg-green-600 hover:bg-green-700 shadow-md 
                               transition-transform hover:scale-105 active:scale-95 text-white font-semibold">
                    Buat Akun 
                </button>
            </form>

            <!-- Login -->
            <p class="text-center text-green-950 font-medium mt-4 text-sm">
                Sudah punya akun?
                <a href="/login" class="text-blue-900 hover:underline font-semibold">
                    Masuk
                </a>
            </p>
        </div>
    </div>
</body>
</html>
