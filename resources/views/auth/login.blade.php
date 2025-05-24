<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 shadow-md rounded-lg">
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-900">Log in to your account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3" type="submit">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <span class="text-sm text-gray-600">OR</span>
            </div>

            <div class="mt-4">
                <a href="{{ route('redirect') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo" class="h-5 w-5 mr-2">
                    {{ __('Continue with Google') }}
                </a>
            </div>

            <!-- Registration Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Don\'t have an account?') }}
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        {{ __('Register here') }}
                    </a>
                </p>
            </div>

            <script>
                document.getElementById('loginForm').addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const email = document.getElementById('email').value;
                    const submitButton = this.querySelector('button[type="submit"]');

                    // Show loading state
                    submitButton.disabled = true;
                    submitButton.innerHTML = '{{ __("Checking...") }}';

                    try {
                        // Check if account exists using your existing routes
                        const response = await fetch('{{ route("login") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new FormData(this)
                        });

                        const data = await response.json();

                        if (response.ok) {
                            // Account exists and credentials are correct
                            this.submit();
                        } else {
                            // Show error from server
                            if (data.errors) {
                                alert(data.message || 'Invalid credentials');
                            } else {
                                alert('Account not found. Please register first.');
                            }
                            submitButton.disabled = false;
                            submitButton.innerHTML = '{{ __("Log in") }}';
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        submitButton.disabled = false;
                        submitButton.innerHTML = '{{ __("Log in") }}';
                        alert('An error occurred. Please try again.');
                    }
                });
            </script>
        </div>
    </div>
</x-guest-layout>
