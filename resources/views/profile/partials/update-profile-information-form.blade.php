<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <!-- Profile Photo Section -->
    <div>
        <x-input-label for="photo" :value="__('Profile Photo')" />

        <!-- Current Profile Photo -->
        <div class="mt-2 flex items-center">
            @if (Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}"
                     class="h-20 w-20 rounded-full object-cover">
            @else
                <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400 text-xs">No photo</span>
                </div>
            @endif

            <div class="ml-4">
                <x-input-label for="photo" :value="__('Profile Photo')" />

                @if ($user->profile_photo_path)
                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}"
                         class="h-20 w-20 rounded-full object-cover mt-2">
                @endif

                <input type="file" name="photo" id="photo" class="mt-2 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100">

                <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                @if (Auth::user()->profile_photo_path)
                    <button
                        type="button"
                        onclick="event.preventDefault(); document.getElementById('delete-photo-form').submit();"
                        class="mt-2 text-sm text-red-600 hover:text-red-900"
                    >
                        {{ __('Remove Photo') }}
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>

<!-- Delete Photo Form (Hidden) -->
<form id="delete-photo-form" method="post" action="{{ route('profile.photo.delete') }}" class="hidden">
    @csrf
    @method('DELETE')
</form>
