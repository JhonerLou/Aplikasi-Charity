<x-app-layout>
    <x-slot name="header">
      <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    </x-slot>

    <div class="space-y-6 p-6">
      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-6 bg-white rounded shadow">
          <div class="text-sm text-gray-500">Campaigns</div>
          <div class="text-2xl font-bold">{{ $totalCampaigns }}</div>
        </div>
        <div class="p-6 bg-white rounded shadow">
          <div class="text-sm text-gray-500">Donations</div>
          <div class="text-2xl font-bold">{{ $totalDonations }}</div>
        </div>
        <div class="p-6 bg-white rounded shadow">
          <div class="text-sm text-gray-500">Raised</div>
          <div class="text-2xl font-bold">${{ number_format($raisedAmount,2) }}</div>
        </div>
      </div>

      <!-- Recent Campaigns -->
      <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold mb-4">Recent Campaigns</h3>
        @forelse($recentCampaigns as $camp)
          <div class="border-b last:border-0 py-2">
            <a href="{{ route('campaigns.show', $camp) }}" class="text-indigo-600 hover:underline">
              {{ $camp->title }}
            </a>
          </div>
        @empty
          <p class="text-gray-500">No campaigns yet.</p>
        @endforelse
      </div>

      <!-- Recent Donations -->
      <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold mb-4">Recent Donations</h3>
        @forelse($recentDonations as $don)
          <div class="border-b last:border-0 py-2 flex justify-between">
            <span>{{ $don->user->name }} → {{ $don->campaign->title }}</span>
            <span>${{ number_format($don->amount,2) }}</span>
          </div>
        @empty
          <p class="text-gray-500">No donations yet.</p>
        @endforelse
      </div>
    </div>
  </x-app-layout>
