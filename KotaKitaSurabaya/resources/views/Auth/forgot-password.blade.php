<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Lupa password Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pembuatan ulang password melalui email.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg" 
                          type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center py-3 bg-green-600 hover:bg-green-700 active:bg-green-800 focus:ring-green-500 rounded-lg">
                {{ __('Kirim Link Reset Password') }}
            </x-primary-button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-green-600 underline">
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>