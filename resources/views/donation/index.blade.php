<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            All Donations
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Donor</th>
                            <th class="px-4 py-2 text-left">Campaign</th>
                            <th class="px-4 py-2 text-left">Amount</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Date</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($donation as $don)
                            <tr>
                                <td class="px-4 py-2">{{ $don->user->name ?? 'Anonymous' }}</td>
                                <td class="px-4 py-2">{{ $don->campaign->title ?? '-' }}</td>
                                <td class="px-4 py-2 text-green-600 font-semibold">${{ number_format($don->amount, 2) }}</td>
                                <td class="px-4 py-2 capitalize">{{ $don->payment_status }}</td>
                                <td class="px-4 py-2">{{ $don->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    @if ($don->payment_status === 'pending')
                                        <form action="{{ route('donation.pay', $don->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded">
                                                Pay
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">No donations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $donation->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
