<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome Back</h1>
                <p class="text-gray-500 text-sm mt-1">Login to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-black"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-black"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-black focus:ring-black">
                        <span class="text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-gray-500 hover:text-black">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-gray-800 transition">
                    Log in
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-sm text-gray-400">or</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-600">
                    Don’t have an account?
                    <a href="{{ route('register') }}"
                       class="text-black font-medium hover:underline">
                        Register
                    </a>
                </p>

            </form>

        </div>

    </div>
</x-guest-layout>