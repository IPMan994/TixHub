<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">TixHub</a>
                </div>

                <!-- Menu Utama -->
                <div class="hidden sm:flex items-center space-x-4">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 {{ request()->is('/') ? 'text-indigo-600 font-medium' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('explore') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 {{ request()->is('explore') ? 'text-indigo-600 font-medium' : '' }}">
                        Explore Events
                    </a>

                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 {{ request()->is('admin*') ? 'text-indigo-600 font-medium' : '' }}">
                        Admin Dashboard
                    </a>
                    @else
                    <a href="{{ route('user.profile') }}"
                        class="text-gray-700 hover:text-indigo-600 px-3 py-2 {{ request()->is('profile') ? 'text-indigo-600 font-medium' : '' }}">
                        My Tickets
                    </a>
                    @endif
                    @endauth
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                    <!-- User dropdown menu -->
                    <div class="relative ml-3">
                        <div class="flex items-center">
                            <span class="text-gray-700 mr-2">{{ Auth::user()->name }}</span>
                            <button type="button" class="flex text-sm rounded-full focus:outline-none" id="user-menu-button">
                                <img class="h-8 w-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=indigo&color=fff"
                                    alt="User profile">
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" id="user-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile menu -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                Home
            </a>
            <a href="{{ route('explore') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('explore') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                Explore Events
            </a>

            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('admin*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                Admin Dashboard
            </a>
            @else
            <a href="{{ route('user.profile') }}"
                class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('profile') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50' }}">
                My Tickets
            </a>
            @endif
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} TixHub. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript untuk dropdown menu -->
    <script>
        document.getElementById('user-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('user-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>