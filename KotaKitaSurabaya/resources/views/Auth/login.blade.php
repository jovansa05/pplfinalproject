<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KotaKita Surabaya</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('/images/hero-bg.jpg');">

    <!-- Overlay soft -->
    <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px]"></div>

    <div class="relative z-10 flex justify-center items-center min-h-screen px-4">
        <div class="bg-white/30 backdrop-blur-xl rounded-3xl p-8 w-full max-w-sm
                    border border-white/40 shadow-[0_4px_20px_rgba(0,0,0,0.15)] transition-all duration-300">

            <!-- Logo -->
            <div class="text-center mb-6">
                <img src="/images/logo_surabaya.png" alt="Logo Surabaya"
                     class="mx-auto w-28 h-28 object-contain mb-3 drop-shadow-md">
                <h2 class="text-3xl font-extrabold text-green-600 tracking-wide drop-shadow-sm">
                    Selamat Datang!
                </h2>
                <p class="text-green-700/90 text-sm font-medium">
                    Silakan masuk untuk melanjutkan 🌱
                </p>
            </div>

            <!-- Form Login -->
            <form action="/login" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-green-900 text-sm font-semibold">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 p-3 rounded-xl bg-white/85 text-gray-900 
                               focus:ring-2 focus:ring-green-500 border-0 shadow-sm placeholder-gray-600">
                </div>

                <div>
                    <label class="block text-green-900 text-sm font-semibold">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 p-3 rounded-xl bg-white/85 text-gray-900 
                               focus:ring-2 focus:ring-green-500 border-0 shadow-sm placeholder-gray-600">
                </div>

                <button type="submit"
                    class="w-full py-3 mt-2 rounded-xl bg-green-600 hover:bg-green-600 shadow-md 
                           transition-transform hover:scale-105 text-white font-semibold tracking-wide">
                    Masuk 🔓
                </button>
            </form>

            <!-- Link ke Register -->
            <p class="text-center text-green-900 mt-4 text-sm font-medium">
                Belum punya akun?
                <a href="/register" class="text-blue-900 hover:underline font-semibold">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

</body>
</html>
