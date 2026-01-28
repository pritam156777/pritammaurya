<x-guest-layout>
    <div class="auth-bg">
        <div class="auth-card">

            <div class="auth-title">
                Create Account 🚀
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" class="block mt-1 w-full"
                                  value="{{ old('name') }}" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" class="block mt-1 w-full"
                                  value="{{ old('email') }}" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" name="password" type="password"
                                  class="block mt-1 w-full" required />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input id="password_confirmation" name="password_confirmation"
                                  type="password" class="block mt-1 w-full" required />
                </div>

                <button class="auth-btn mt-6">
                    Register
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="auth-link">
                    Already have account? Login →
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
