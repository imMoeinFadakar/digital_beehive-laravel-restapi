<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="personel_code" :value="__('کد پرسنلی')" />
            <x-text-input id="personel_code" class="block mt-1 w-full" type="text" name="personel_code" :value="old('personel_code')" required autofocus autocomplete="personel_code" />
            <x-input-error :messages="$errors->get('personel_code')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('گذرواژه')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

    

        <div class="flex items-center justify-end mt-4">
         

            <x-primary-button class="ms-3">
                {{ __('وارد شوید') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
