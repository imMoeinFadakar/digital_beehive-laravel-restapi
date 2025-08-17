<x-guest-layout>
    <form method="POST" action="{{ route('store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="first_name" :value="__('first_name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>


           <!-- last_name -->
        <div>
            <x-input-label for="last_name" :value="__('last_name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('first_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="personel_code" :value="__('personel_code')" />
            <x-text-input id="personel_code" class="block mt-1 w-full" type="text" name="personel_code" :value="old('personel_code')" required autocomplete="personel_code" />
            <x-input-error :messages="$errors->get('personel_code')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

    

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('ذخیره کردن') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
