<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - KotaKita Surabaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen"
      style="background-image: url('{{ asset('images/auth-bg.jpg') }}');">

    <div class="absolute inset-0 bg-black/10"></div>

    <div class="relative z-10 flex justify-center items-center min-h-screen px-4">
        <div class="bg-white/40 backdrop-blur-xl rounded-3xl p-8 w-full max-w-md
                    border border-white/50 shadow-[0_8px_32px_rgba(0,0,0,0.1)] transition-all duration-300">

            <div class="text-center mb-6">
                <img src="{{ asset('images/logo_surabaya.png') }}" alt="Logo Surabaya"
                     class="mx-auto w-24 h-24 object-contain mb-3 drop-shadow-md hover:scale-105 transition">
                <h2 class="text-2xl font-extrabold text-green-800 tracking-wide drop-shadow-sm">
                    Verifikasi Email 
                </h2>
                <p class="text-green-900 text-sm font-medium mt-2 leading-relaxed">
                    Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 p-3 bg-green-100/90 border border-green-400 text-green-800 rounded-xl text-sm text-center font-bold shadow-sm">
                    Link verifikasi baru telah dikirim ke alamat email Anda. 
                </div>
            @endif

            <div class="flex flex-col gap-3 mt-6">
                
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full py-3 rounded-xl bg-green-600 hover:bg-green-700 shadow-lg hover:shadow-green-500/30
                               transition-all transform hover:-translate-y-0.5 text-white font-bold tracking-wide text-lg cursor-pointer">
                        Kirim Ulang Link Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl border-2 border-green-600 text-green-800 hover:bg-green-50 font-bold transition">
                        Keluar (Logout)
                    </button>
                </form>

            </div>

        </div>
    </div>

</body>
</html>