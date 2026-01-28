<x-guest-layout>
    <div class="auth-bg">

        <div class="auth-card">

            <div class="auth-title">
                {{ auth()->check() ? 'Welcome Back 👋' : 'Login Account ' }}
            </div>

            {{-- Status Message --}}
            @if(session('status'))
                <div class="mb-4 p-3 rounded bg-green-500 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            @auth
                <!-- LOGOUT FORM -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="auth-btn logout-btn">
                        Logout
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('dashboard') }}" class="auth-link">
                        Go to Dashboard →
                    </a>
                </div>
            @else
                <!-- LOGIN FORM -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email"
                                      class="block mt-1 w-full"
                                      value="{{ old('email') }}" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password"
                                      class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label class="flex items-center text-white text-sm">
                            <input type="checkbox" name="remember" class="mr-2">
                            Remember me
                        </label>

                        <a href="#" class="auth-link">
                            Forgot Password?
                        </a>
                    </div>

                    <button class="auth-btn mt-6">
                        Login
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="auth-link">
                        Create new account →
                    </a>
                </div>
            @endauth

        </div>
    </div>
</x-guest-layout>
