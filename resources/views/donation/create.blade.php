<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Make a Donation</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <form method="POST" action="{{ route('donation.store') }}">
            @csrf

            <input type="hidden" name="campaign_id" value="{{ $selectedCampaign }}">

            <div class="mb-4">
                <label class="block text-sm font-medium">Campaign</label>
                <p class="mt-1 font-medium">{{ $campaignTitle }}</p>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium">Amount</label>
                <input type="number" name="amount" id="amount"
                       class="w-full border-gray-300 rounded mt-1" min="1" required>
                @error('amount') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Full Name</label>
                <input type="text" name="name" id="name"
                       class="w-full border-gray-300 rounded mt-1"
                       value="{{ auth()->user() ? auth()->user()->name : '' }}" required>
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full border-gray-300 rounded mt-1"
                       value="{{ auth()->user() ? auth()->user()->email : '' }}" required>
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium">Message (optional)</label>
                <textarea name="message" id="message" rows="3" class="w-full border-gray-300 rounded mt-1"></textarea>
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_anonymous" class="rounded border-gray-300 text-indigo-600">
                    <span class="ml-2 text-sm text-gray-600">Make this donation anonymously</span>
                </label>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Continue to Payment</button>
        </form>
    </div>
</x-app-layout>
