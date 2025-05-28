<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-6 text-center">Create Campaign</h1>

        <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="block mt-1 w-full rounded border-gray-300" required>{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Category -->
            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />
                <select id="category" name="category" class="block mt-1 w-full rounded border-gray-300">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <!-- Target Amount -->
            <div class="mt-4">
                <x-input-label for="target_amount" :value="__('Target Amount')" />
                <x-text-input id="target_amount" class="block mt-1 w-full" type="number" name="target_amount"
                    :value="old('target_amount')" required />
                <x-input-error :messages="$errors->get('target_amount')" class="mt-2" />
            </div>

            <!-- Contact Email -->
            <div class="mt-4">
                <x-input-label for="contact_email" :value="__('Contact Email')" />
                <x-text-input id="contact_email" class="block mt-1 w-full" type="email"
                    name="contact_email" :value="old('contact_email')" />
                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Campaign Image')" />
                <input id="image" class="block mt-1 w-full" type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    {{ __('Create Campaign') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
