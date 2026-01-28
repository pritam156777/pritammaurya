<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">


            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->check() ? route('dashboard') : route('shop.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                {{-- Home Link --}}


                <!-- Navigation Links Cam Remove "hidden" to show  headers here http://localhost:8000/cart-->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link
                        :href="route('home')"
                        :active="request()->routeIs('home')"
                    >
                        {{ __('Home') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth

                     {{--   <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.*')">
                            {{ __('Shop') }}
                        </x-nav-link>--}}

                    @auth
                        @if(auth()->user()->role === 'super_admin')


                            <x-nav-link
                                :href="route('super-admin.admins.create')"
                                :active="request()->routeIs('super-admin.admins.create')"
                            >
                                {{ __('Create Admin') }}
                            </x-nav-link>

                            <x-nav-link
                                :href="route('super-admin.categories.create')"
                                :active="request()->routeIs('super-admin.categories.create')"
                            >
                                {{ __('Create Categories') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link
                                :href="route('products.index')"
                                :active="request()->routeIs('products.*')"
                            >
                                {{ __('Add Products') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150 gap-2">

                                <!-- User Avatar -->
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>

                                <!-- User Name -->
                                <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>

                                <!-- Dropdown Arrow -->
                                <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                               {{-- <p class="text-gray-500 text-xs truncate">{{ Auth::user()->email }}</p> <p class="text-gray-400 text-xs mt-1">
                                    Last logged in:
                                    @if(Auth::user()->last_login_at)
                                        {{ Auth::user()->last_login_at}}
                                    @else
                                        First login
                                    @endif
                                </p>--}}
                            </div>

                            <!-- Dashboard Link -->{{--
                            <x-dropdown-link href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3h18v18H3V3z"></path>
                                </svg>
                                Dashboard
                            </x-dropdown-link>

                            <!-- Profile Link -->
                            <x-dropdown-link href="#" class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5.121 17.804A13.937 13.937 0 0112 15c2.848 0 5.527.81 7.879 2.198M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Profile
                            </x-dropdown-link>--}}

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-2 px-4 py-2 text-red-600 font-semibold hover:bg-red-50 rounded-md transition-all duration-200">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"></path>
                                    </svg>
                                    <span>Log Out</span>                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>





                </div>
            @endauth


            <!-- Guest Links -->
            @guest
                @guest
                    <div class="hidden sm:flex sm:items-center sm:ms-6 auth-nav">
                        <a href="{{ route('login') }}"
                           class="auth-btn auth-btn-login">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="auth-btn auth-btn-register">
                            Register
                        </a>
                    </div>
                @endguest

            @endguest

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('shop.index')">
                {{ __('Shop') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>

</nav>

<div id="flash-messages" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 space-y-4 w-full max-w-lg">

    {{-- Success --}}
    <div id="flash-messages" class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 space-y-4 w-full max-w-lg">

        @php
            $flashTypes = [
                'success' => ['color' => 'green', 'border' => 'border-green-600'],
                'error'   => ['color' => 'red', 'border' => 'border-red-600'],
                'warning' => ['color' => 'yellow', 'border' => 'border-yellow-600'],
                'info'    => ['color' => 'blue', 'border' => 'border-blue-600'],
            ];
        @endphp

        @foreach($flashTypes as $type => $data)
            @if(session($type))
                <div class="flash-message {{ $type }}-message relative p-4 rounded-2xl shadow-xl overflow-hidden {{ $data['border'] }}" style="color: {{ $data['color'] }} !important;">
                    <div class="animated-bg absolute inset-0 -z-10"></div>
                    <div class="flash-content flex items-center justify-between relative z-10 space-x-3">
                        <span class="font-bold uppercase" style="color: {{ $data['color'] }} !important;">{{ strtoupper($type) }}:</span>
                        <span class="font-semibold text-lg" style="color: {{ $data['color'] }} !important;">{{ session($type) }}</span>
                        <button class="close-btn font-bold text-xl" style="color: {{ $data['color'] }} !important;">&times;</button>
                    </div>
                </div>
            @endif
        @endforeach

    </div>


</div>




