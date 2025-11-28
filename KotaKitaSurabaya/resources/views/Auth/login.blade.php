<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KotaKita Surabaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">

    <div class="absolute inset-0 bg-white/10 backdrop-blur-[2px]"></div>

    <div class="relative z-10 flex justify-center items-center min-h-screen px-4">
        <div class="bg-white/40 backdrop-blur-xl rounded-3xl p-8 w-full max-w-sm
                    border border-white/50 shadow-[0_8px_32px_rgba(0,0,0,0.1)] transition-all duration-300">

            <div class="text-center mb-6">
                <img src="{{ asset('images/logo_surabaya.png') }}" alt="Logo Surabaya"
                     class="mx-auto w-24 h-24 object-contain mb-3 drop-shadow-md hover:scale-105 transition">
                <h2 class="text-3xl font-extrabold text-green-800 tracking-wide drop-shadow-sm">
                    Selamat Datang!
                </h2>
                <p class="text-green-900 text-sm font-medium mt-1">
                    Silakan masuk untuk melanjutkan 🌱
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100/80 border border-red-200 text-red-700 rounded-xl text-sm text-center font-bold">
                    Email atau Password salah.
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-green-900 text-sm font-bold ml-1 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full p-3 rounded-xl bg-white/80 border border-white/50 text-gray-900 
                               focus:ring-2 focus:ring-green-500 focus:outline-none shadow-inner placeholder-gray-500"
                        placeholder="email@contoh.com">
                </div>

                <div>
                    <label class="block text-green-900 text-sm font-bold ml-1 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full p-3 rounded-xl bg-white/80 border border-white/50 text-gray-900 
                               focus:ring-2 focus:ring-green-500 focus:outline-none shadow-inner placeholder-gray-500"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-sm mt-2">
                    <label class="flex items-center text-green-900 font-semibold cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500 mr-2">
                        Ingat Saya
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-green-800 hover:text-green-600 hover:underline font-bold">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-3 mt-4 rounded-xl bg-green-600 hover:bg-green-700 shadow-lg hover:shadow-green-500/30
                           transition-all transform hover:-translate-y-0.5 text-white font-bold tracking-wide text-lg">
                    Masuk 🔓
                </button>
            </form>

            <p class="text-center text-green-900 mt-6 text-sm font-medium">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-700 hover:text-green-500 hover:underline font-bold transition">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

</body>
</html>