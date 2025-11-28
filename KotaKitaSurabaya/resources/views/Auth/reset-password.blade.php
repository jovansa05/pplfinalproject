<x-guest-layout>
    <h2 class="text-center text-xl font-bold text-gray-700 mb-6">Buat Password Baru</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 bg-gray-100 text-gray-500 rounded-lg cursor-not-allowed" 
                          type="email" name="email" :value="old('email', $request->email)" required autofocus readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password Baru')" class="text-gray-600" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg" 
                          type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-600" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                            type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-green-600 hover:bg-green-700 active:bg-green-800 focus:ring-green-500 rounded-lg">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>