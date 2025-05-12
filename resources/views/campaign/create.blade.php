<!-- resources/views/campaigns/create.blade.php -->
<x-guest-layout>
    <h1>Create Campaign</h1>

    <form action="{{ route('campaign.edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" class="block mt-1 w-full" name="description" required></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Target Amount -->
        <div class="mt-4">
            <x-input-label for="target" :value="__('Target Amount')" />
            <x-text-input id="target" class="block mt-1 w-full" type="number" name="target" required />
            <x-input-error :messages="$errors->get('target')" class="mt-2" />
        </div>

        <!-- Image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Campaign Image')" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="ms-3">
                {{ __('Create Campaign') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
