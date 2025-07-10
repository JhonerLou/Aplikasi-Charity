<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Donation Details</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-800">Donation Information</h3>
                <div class="mt-4 space-y-3">
                    <p class="text-gray-600">Campaign: <span class="font-medium">{{ $donation->campaign->title }}</span></p>
                    <p class="text-gray-600">Amount: <span class="font-medium">${{ number_format($donation->amount, 2) }}</span></p>
                    <p class="text-gray-600">Status: <span class="font-medium capitalize">{{ $donation->payment_status }}</span></p>
                    <p class="text-gray-600">Date: <span class="font-medium">{{ $donation->created_at->format('F j, Y') }}</span></p>
                    @if(!$donation->is_anonymous)
                        <p class="text-gray-600">Donor: <span class="font-medium">{{ $donation->donor_name }}</span></p>
                    @endif
                    @if($donation->message)
                        <div class="mt-4">
                            <p class="text-gray-600">Message:</p>
                            <p class="mt-2 text-gray-800">{{ $donation->message }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
