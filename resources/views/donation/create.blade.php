<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Make a Donation</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <form method="POST" action="{{ route('donation.store') }}">
            @csrf

            <div class="mb-4">
                <label for="campaign_id" class="block text-sm font-medium">Select Campaign</label>
                <select name="campaign_id" id="campaign_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach($campaigns as $id => $title)
                        <option value="{{ $id }}" {{ $selectedCampaign == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
                @error('campaign_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium">Amount</label>
                <input type="number" name="amount" class="w-full border-gray-300 rounded mt-1" min="1" required>
                @error('amount') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium">Message (optional)</label>
                <textarea name="message" rows="3" class="w-full border-gray-300 rounded mt-1"></textarea>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Donate</button>
        </form>
    </div>
</x-app-layout>
