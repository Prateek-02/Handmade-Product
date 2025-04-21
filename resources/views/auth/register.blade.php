<x-guest-layout>
    <x-slot name="title">Register</x-slot>
    <div class="flex w-full">
        <!-- Left side - Image -->
        <div class="hidden lg:block lg:w-1/2">
            <div class="h-full relative">
                <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" 
                    alt="Handmade crafts" 
                    class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-indigo-900 bg-opacity-30 flex flex-col justify-center items-center text-white p-10">
                    <div class="bg-black bg-opacity-40 p-8 rounded-lg max-w-md">
                        <h2 class="text-3xl font-bold mb-4">Discover Handmade Treasures</h2>
                        <p class="mb-6">Join our community of artisans and craft enthusiasts. Buy unique items or sell your handmade creations.</p>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <div class="bg-white bg-opacity-20 p-3 rounded-lg text-center">
                                <span class="block text-2xl font-bold">1000+</span>
                                <span class="text-sm">Artisans</span>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-lg text-center">
                                <span class="block text-2xl font-bold">5000+</span>
                                <span class="text-sm">Products</span>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-lg text-center">
                                <span class="block text-2xl font-bold">10k+</span>
                                <span class="text-sm">Happy Customers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side - Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-4 bg-gradient-to-br from-indigo-50 to-purple-50">
            <div class="w-full max-w-xl">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Join Our Community</h1>
                    <p class="text-sm text-gray-600">Create your Handmade Marketplace account today</p>
                </div>
                
                <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded-lg shadow-lg">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-semibold" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" minlength="3" maxlength="30" pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <p class="text-xs text-gray-500 mt-1">Name should be 3-30 characters and contain only letters and spaces.</p>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        
                    </div>

                    <!-- Role Selection -->
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Register As')" class="text-gray-700 font-semibold" />
                        <select name="role" id="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Role</option>
                            <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                            <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-semibold" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-300" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between mt-6">
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition duration-300 mb-3 sm:mb-0" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="w-full sm:w-auto justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-5 rounded-md shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-500">
                        &copy; {{ date('Y') }} Handmade Marketplace. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
