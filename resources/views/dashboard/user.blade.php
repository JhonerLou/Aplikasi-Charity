<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Your Dashboard</h2>
            <div class="text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}!</div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- My Donations Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">My Donations</h3>
                    <span class="text-sm font-medium text-indigo-600">
                        Total: ${{ number_format($myDonations ? $myDonations->sum('amount') : 0, 2) }}
                    </span>
                </div>

                @if ($myDonations && $myDonations->isEmpty())
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-2 text-gray-500">You haven't donated yet</p>
                    <a href="{{ route('campaign.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Find a Campaign to Support
                    </a>
                </div>
                @elseif ($myDonations)
                <div class="space-y-4">
                    @foreach ($myDonations as $don)
                    <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $don->campaign->title ?? 'Unknown Campaign' }}</p>
                            <p class="text-sm text-gray-500">{{ $don->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-600">${{ number_format($don->amount, 2) }}</p>
                            <p class="text-xs text-gray-500">{{ $don->status ?? 'Completed' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    Unable to load donation history
                </div>
                @endif
            </div>
        </div>

        <!-- Campaigns to Donate To -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Featured Campaigns</h3>
                    <a href="{{ route('campaign.index') }}" class="text-sm text-indigo-600 hover:underline">View All Campaigns</a>
                </div>

                @if ($campaigns && $campaigns->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($campaigns as $camp)
                    <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <div class="relative h-40 bg-gray-100">
                            @if ($camp->image)
                            <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <h4 class="text-white font-semibold">{{ $camp->title }}</h4>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-500">
                                    Raised: ${{ number_format($camp->donations ? $camp->donations->sum('amount') : 0, 2) }}
                                </span>
                                <span class="text-sm font-medium text-indigo-600">
                                    {{ $camp->donations_count ?? 0 }} donations
                                </span>
                            </div>
                            <a href="{{ route('donation.create', ['campaign_id' => $camp->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Donate Now
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    No campaigns available at this time
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="{{ route('profile.edit') }}" class="bg-blue-50 hover:bg-blue-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-blue-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Update Profile</p>
                </a>
                <a href="{{ route('campaign.index') }}" class="bg-green-50 hover:bg-green-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-green-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Donate Again</p>
                </a>
                <a href="#" class="bg-purple-50 hover:bg-purple-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-purple-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Tax Receipts</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
