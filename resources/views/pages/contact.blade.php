<x-app-layout>
    <x-slot name="title">Contact Us</x-slot>
    <x-slot name="header">
        <h2 class="text-4xl font-extrabold text-center text-indigo-800 mb-6">Get in Touch</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-10 px-8 bg-gradient-to-r from-indigo-100 to-indigo-50 shadow-xl rounded-xl border border-gray-200">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
            @csrf

            <!-- Name Input -->
            <div>
                <label class="block text-lg font-semibold text-gray-800">Your Name</label>
                <input type="text" name="name" required placeholder="Enter your full name" minlength="3" maxlength="30" pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces"
                    class="w-full mt-1 p-4 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition duration-200 shadow-md placeholder-gray-500">
            </div>

            <!-- Email Input -->
            <div>
                <label class="block text-lg font-semibold text-gray-800">Your Email</label>
                <input type="email" name="email" required placeholder="Enter your email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address"
                    class="w-full mt-1 p-4 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition duration-200 shadow-md placeholder-gray-500">
            </div>

            <!-- Message Input -->
            <div>
                <label class="block text-lg font-semibold text-gray-800">Your Message</label>
                <textarea name="message" rows="6" required placeholder="Write your message here" minlength="5" maxlength="250"
                    class="w-full mt-1 p-4 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition duration-200 shadow-md placeholder-gray-500"></textarea>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold px-6 py-4 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-lg transform hover:scale-105 focus:outline-none focus:ring focus:ring-indigo-200">
                    Send Your Message
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
