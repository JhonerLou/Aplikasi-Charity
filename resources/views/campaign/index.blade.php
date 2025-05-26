<x-guest-layout>
    <div class="w-full min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">All Campaigns</h1>
                <p class="text-gray-600 mt-2">Browse and support meaningful causes</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('dashboard') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg text-lg font-medium transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('campaign.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg font-medium transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Create Campaign
                </a>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="mb-8">
            <!-- Search Form -->
            <form method="GET" action="{{ route('campaign.index') }}" class="mb-6">
                <div class="relative max-w-md">
                    <input type="text" name="search" placeholder="Search campaigns..."
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>

            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('campaign.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition
                          {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    All Categories
                </a>
                @foreach(['natural disaster', 'orphanage', 'needs crisis', 'special needs'] as $category)
                    <a href="{{ route('campaign.index', ['category' => $category]) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition
                              {{ request('category') == $category ?
                                 'bg-blue-600 text-white' :
                                 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ ucwords($category) }}
                    </a>
                @endforeach
            </div>
        </div>

        @if($campaign->isEmpty())
            <div class="bg-white p-10 text-center rounded-lg shadow-lg max-w-2xl mx-auto">
                <div class="mx-auto w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-medium text-gray-800 mb-2">No campaigns found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search or filter criteria</p>
                <a href="{{ route('campaign.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                    Start a Campaign
                </a>
            </div>
        @else
            <!-- Campaign Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($campaign as $camp)
                    <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        @if($camp->image)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $camp->image) }}"
                                     alt="{{ $camp->title }}"
                                     class="w-full h-full object-cover transition duration-500 hover:scale-105">
                            </div>
                        @endif

                        <div class="p-5">
                            <!-- Category Badge -->
                            <div class="mb-3">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    @if($camp->category == 'natural disaster') bg-red-100 text-red-800
                                    @elseif($camp->category == 'orphanage') bg-purple-100 text-purple-800
                                    @elseif($camp->category == 'needs crisis') bg-orange-100 text-orange-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucwords($camp->category) }}
                                </span>
                            </div>

                            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $camp->title }}</h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $camp->description }}</p>

                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-xs font-medium text-gray-500">Target Amount</p>
                                    <p class="text-blue-600 font-bold">${{ number_format($camp->target_amount, 2) }}</p>
                                </div>
                                @if($camp->contact_email)
                                <div class="text-right">
                                    <p class="text-xs font-medium text-gray-500">Contact</p>
                                    <p class="text-sm text-gray-700 truncate">{{ $camp->contact_email }}</p>
                                </div>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('donation.create', ['campaign_id' => $camp->id]) }}"
                                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg text-center transition">
                                    Donate
                                </a>
                                <a href="{{ route('campaign.edit', $camp->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                                    Edit
                                </a>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                <form action="{{ route('campaign.destroy', $camp->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($campaign->hasPages())
                <div class="mt-8">
                    {{ $campaign->appends(request()->query())->links() }}
                </div>
            @endif
        @endif
    </div>
</x-guest-layout>
