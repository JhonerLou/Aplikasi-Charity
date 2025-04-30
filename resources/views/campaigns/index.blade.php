<x-guest-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Campaign List</h1>
    </x-slot>

    @foreach ($campaigns as $campaign)
        <div class="mt-4 p-4 border rounded shadow">
            <h2 class="text-xl font-bold">{{ $campaign->title }}</h2>
            <p>{{ $campaign->description }}</p>
            <p>Target: ${{ number_format($campaign->target, 2) }}</p>
        </div>
    @endforeach
</x-guest-layout>
