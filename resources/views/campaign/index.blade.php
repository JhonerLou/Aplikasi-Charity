<x-guest-layout>
    <div class="w-full min-h-screen py-10">
        <!-- Header with Button -->
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">All Campaigns</h1>
            <a href="{{ route('campaign.create') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-blue-700 transition">
                + Create Campaign
            </a>
        </div>

        @if($campaign->isEmpty())
            <div class="bg-white p-10 text-center rounded-lg shadow">
                <p class="text-xl text-gray-600">No campaigns available yet.</p>
                <p class="mt-2 text-gray-500">Click the "Create Campaign" button above to get started.</p>
            </div>
        @else
            <!-- Responsive Campaign Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($campaign as $camp)
                    <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition">
                        @if($camp->image)
                            <img src="{{ asset('storage/' . $camp->image) }}"
                                 alt="{{ $camp->title }}"
                                 class="w-full h-60 object-cover">
                        @endif
                        <div class="p-5">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $camp->title }}</h2>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($camp->description, 100) }}</p>
                            <p class="text-sm font-medium text-gray-700">Target:</p>
                            <p class="text-blue-600 font-bold text-lg">${{ number_format($camp->target_amount, 2) }}</p>
                            <a href="{{ route('donation.create', ['campaign_id' => $camp->id]) }}"
                                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded">
                                 Donate
                             </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>
