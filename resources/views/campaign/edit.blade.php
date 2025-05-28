<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-6 text-center">Edit Campaign</h1>

        <form action="{{ route('campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title', $campaign->title) }}" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $campaign->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Target Amount -->
            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />
                <select id="category" name="category" class="block mt-1 w-full rounded border-gray-300">
                    @foreach (['Natural Disaster', 'Orphanage', 'Needs Crisis', 'Special Needs'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="contact_email" :value="__('Contact Email')" />
                <x-text-input id="contact_email" class="block mt-1 w-full" type="email"
                    name="contact_email" value="{{ old('contact_email', $campaign->contact_email) }}" />
                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="target_amount" :value="__('Target Amount')" />
                <x-text-input id="target_amount" class="block mt-1 w-full" type="number" name="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" required />
                <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
            </div>

            <!-- Category -->

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Campaign Image')" />
                <input id="image" class="block mt-1 w-full" type="file" name="image" />
                @if ($campaign->image)
                    <img src="{{ asset('storage/' . $campaign->image) }}" alt="Current image" class="mt-2 w-full h-48 object-cover rounded">
                @endif
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Update Campaign') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
