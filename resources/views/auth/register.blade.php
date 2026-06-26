<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-semibold text-slate-900" style="font-family: 'Poppins', sans-serif;">Create your account</h1>
        <p class="mt-2 text-sm text-slate-500">Register as Pharmacist</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" required
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-[#2e7d8c] focus:ring focus:ring-[#2e7d8c]/50">
                <option value="Pharmacist" selected>{{ __('Pharmacist') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
               class="text-sm font-medium hover:underline"
               style="color: #2e7d8c;">
                Already have an account? Sign in
            </a>

            <button type="submit"
                class="px-6 py-2 rounded-lg text-white text-sm font-semibold transition hover:opacity-90"
                style="background-color: #2e7d8c;">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>