<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - KotaKita Surabaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('/images/alunalun.jpg');">

    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10 flex justify-center items-center min-h-screen px-4">
        <div class="bg-white/40 backdrop-blur-xl rounded-3xl p-8 w-full max-w-md
                    border border-white/50 shadow-[0_8px_32px_rgba(0,0,0,0.1)]">

            
            <div class="text-center mb-5">
                <img src="{{ asset('images/logo_surabaya.png') }}" 
                     class="mx-auto max-w-[140px] w-full object-contain mb-3 drop-shadow-md hover:scale-105 transition">
                <h2 class="text-3xl font-extrabold text-green-800">Reset Password</h2>
                <p class="text-green-900 text-sm font-medium mt-1">
                    Masukkan email Anda untuk menerima link reset password.
                </p>
            </div>

           
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-800 rounded-xl text-sm text-center font-semibold">
                    {{ session('status') }}
                </div>
            @endif

        
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-green-900 font-semibold text-sm mb-1">Email</label>
                    <input type="email" name="email" required autofocus
                        class="w-full p-3 rounded-xl bg-white/80 border border-white/50 text-gray-900
                               focus:ring-2 focus:ring-green-600 shadow-inner placeholder-gray-500"
                        placeholder="email@contoh.com">
                </div>

                @if ($errors->any())
                    <p class="text-red-700 text-center text-sm font-bold">
                        Terjadi kesalahan, pastikan email benar.
                    </p>
                @endif

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold text-lg
                           shadow-lg hover:shadow-green-500/30 transition-all transform hover:-translate-y-0.5">
                    Kirim Link Reset Password
                </button>
            </form>

            <p class="text-center text-green-900 mt-5 text-sm font-medium">
                <a href="{{ route('login') }}" class="text-blue-900 hover:underline font-semibold">
                    Kembali ke Login
                </a>
            </p>
        </div>
    </div>

</body>
</html>
