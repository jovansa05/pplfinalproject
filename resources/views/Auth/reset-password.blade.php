<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - KotaKita Surabaya</title>
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
                     class="mx-auto w-28 h-28 object-contain mb-3 drop-shadow-md hover:scale-105 transition">
                <h2 class="text-2xl font-extrabold text-green-800 tracking-wide drop-shadow-sm">
                    Buat Password Baru
                </h2>
                <p class="text-green-900 text-sm font-medium mt-2">
                    Silakan atur ulang kata sandi Anda untuk keamanan akun.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100/80 border border-red-200 text-red-700 rounded-xl text-sm text-center font-bold">
                    Terjadi kesalahan pada input data.
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="block text-green-900 text-sm font-bold ml-1 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                        class="w-full p-3 rounded-xl bg-gray-100/80 border border-white/50 text-gray-500 cursor-not-allowed
                               focus:outline-none shadow-inner placeholder-gray-500">
                </div>

                <div>
                    <label class="block text-green-900 text-sm font-bold ml-1 mb-1">Password Baru</label>
                    <input type="password" name="password" required autofocus autocomplete="new-password"
                        class="w-full p-3 rounded-xl bg-white/80 border border-white/50 text-gray-900 
                               focus:ring-2 focus:ring-green-500 focus:outline-none shadow-inner placeholder-gray-500"
                        placeholder="Minimal 8 karakter">
                    @if($errors->has('password'))
                        <p class="text-red-600 text-xs mt-1 font-bold">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-green-900 text-sm font-bold ml-1 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full p-3 rounded-xl bg-white/80 border border-white/50 text-gray-900 
                               focus:ring-2 focus:ring-green-500 focus:outline-none shadow-inner placeholder-gray-500"
                        placeholder="Ulangi password baru">
                </div>

                <button type="submit"
                    class="w-full py-3 mt-4 rounded-xl bg-green-600 hover:bg-green-700 shadow-lg hover:shadow-green-500/30
                           transition-all transform hover:-translate-y-0.5 text-white font-bold tracking-wide text-lg">
                    Simpan Password Baru 
                </button>
            </form>

        </div>
    </div>

</body>
</html>