<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Donation Successful</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="mb-6">
                <div class="text-green-500 mb-4">
                    <svg class="h-16 w-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-medium text-gray-900 mb-4">Thank You for Your Donation!</h3>
                <p class="text-gray-600 mb-6">Your donation has been processed successfully.</p>
                <div class="space-y-4">
                    <a href="{{ route('dashboard') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
