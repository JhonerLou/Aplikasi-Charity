<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Your Dashboard</h2>
    </x-slot>

    <div class="space-y-6 p-6">
        <!-- My Donations -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold mb-4">My Donations</h3>
            @if ($myDonations->isEmpty())
                <p class="text-gray-500">You haven’t donated yet.</p>
            @else
                @foreach ($myDonations as $don)
                    <div class="border-b last:border-0 py-2 flex justify-between">
                        <span>{{ $don->campaign->title }}</span>
                        <span>${{ number_format($don->amount, 2) }}</span>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Donate to a Campaign -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="font-semibold mb-4">Donate to a Campaign</h3>
            <a href="{{ route('campaign.index') }}">See All Campaigns</a>
            @foreach ($campaigns as $camp)
                <div class="border-b last:border-0 py-4 flex items-center space-x-4">
                    @if ($camp->image)
                        <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->title }}"
                            class="w-16 h-16 object-cover rounded" />
                    @else
                        <div
                            class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-sm">
                            No Image
                        </div>
                    @endif

                    <div class="flex-1">
                        <span class="block font-semibold text-gray-800">{{ $camp->title }}</span>
                        <a href="{{ route('donation.create', ['campaign_id' => $camp->id]) }}"
                            class="text-indigo-600 hover:underline text-sm">Donate →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
