<x-guest-layout>
    <x-slot name="title">Login</x-slot>
    <div class="flex w-full">
        <!-- Left side - Image -->
        <div class="hidden lg:block lg:w-1/2">
            <img src="https://plus.unsplash.com/premium_photo-1681487929886-4c16ad2f2387?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fHdlbGNvbWUlMjB0byUyMHNob3BwaW5nJTIwYXBwfGVufDB8fDB8fHww" 
                alt="Handmade crafts" 
                class="w-full h-full object-cover" />
        </div>
        
        <!-- Right side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-4 bg-gradient-to-br from-indigo-50 to-purple-50">
            <div class="w-full max-w-xl">
                <div class="text-center mb-4">
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">Welcome Back</h1>
                    <p class="text-sm text-gray-600">Sign in to your Handmade Marketplace account</p>
                </div>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-2" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="bg-white p-5 rounded-lg shadow-lg">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-3">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-row items-center justify-between mt-3">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition duration-300" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="w-auto justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-5 rounded-md shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <p class="text-sm text-gray-600">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium">
                                Register now
                            </a>
                        </p>
                    </div>
                </form>
                
                <div class="mt-2 text-center">
                    <p class="text-xs text-gray-500">
                        &copy; {{ date('Y') }} Handmade Marketplace. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
