<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
            <div class="text-sm text-gray-500">Last updated: {{ now()->format('M d, Y h:i A') }}</div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Stats Cards with Animation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Campaigns Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                <div class="p-6 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium opacity-80">Total Campaigns</p>
                            <p class="text-3xl font-bold mt-1">{{ $totalCampaigns }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-1 bg-white/30 rounded-full">
                            <div class="h-1 bg-white rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donations Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                <div class="p-6 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium opacity-80">Total Donations</p>
                            <p class="text-3xl font-bold mt-1">{{ $totalDonations }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-1 bg-white/30 rounded-full">
                            <div class="h-1 bg-white rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Raised Amount Card -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                <div class="p-6 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium opacity-80">Total Raised</p>
                            <p class="text-3xl font-bold mt-1">${{ number_format($raisedAmount, 2) }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-1 bg-white/30 rounded-full">
                            <div class="h-1 bg-white rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Campaigns -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Recent Campaigns</h3>
                        <a href="{{ route('campaign.index') }}" class="text-sm text-indigo-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($recentCampaigns as $camp)
                        <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="bg-indigo-100 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('campaign.index', $camp->title ) }}" class="font-medium text-gray-800 hover:text-indigo-600 transition-colors duration-200">{{ $camp->title }}</a>
                                <p class="text-sm text-gray-500 mt-1">Created {{ $camp->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-sm font-medium text-indigo-600">{{ $camp->donations_count }} donations</div>
                        </div>
                        @empty
                        <div class="text-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-gray-500">No campaigns yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Donations -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Recent Donations</h3>
                        <a href="#" class="text-sm text-indigo-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($recentDonations as $don)
                        <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="bg-green-100 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">{{ $don->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $don->campaign->title }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600">${{ number_format($don->amount, 2) }}</p>
                                <p class="text-xs text-gray-500">{{ $don->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-gray-500">No donations yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('campaign.create') }}" class="bg-indigo-50 hover:bg-indigo-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-indigo-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">New Campaign</p>
                </a>
                <a href="{{ route('users.index') }}" class="bg-blue-50 hover:bg-blue-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-blue-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Manage Users</p>
                </a>
                <a href="#" class="bg-green-50 hover:bg-green-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-green-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Verify Donations</p>
                </a>
                <a href="#" class="bg-purple-50 hover:bg-purple-100 rounded-lg p-4 text-center transition-colors duration-200">
                    <div class="bg-purple-100 p-3 rounded-full inline-block mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <p class="font-medium text-gray-800">Reports</p>
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Smooth animations */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Custom scrollbar for tables */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</x-app-layout>
