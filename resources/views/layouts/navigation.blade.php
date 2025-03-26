<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Authentication Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <span class="font-bold uppercase mr-4">Welcome, {{ auth()->user()->name }}</span>
                    <x-nav-link href="/listings/manage"> <i class="fa-solid fa-gear"></i> Manage Listings </x-nav-link>
                    @role('admin')
                        <x-nav-link href="{{ route('admin.users.index') }}"> <i class="fa-solid fa-users-gear"></i> Manage
                            Users </x-nav-link>
                    @endrole

                    {{-- @if (auth()->user()->role === 'admin')
                        <p class="text-green-500">You are an admin</p>
                        <x-nav-link href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-users-gear"></i> Manage Users
                        </x-nav-link>
                    @else
                        <p class="text-red-500">You are NOT an admin</p>
                    @endif --}}
                    {{-- @if (auth()->user()->role === 'admin')
                        <p class="text-green-500">You are an admin</p>

                        <p>Roles: {{ json_encode(auth()->user()->getRoleNames()) }}</p>
                        <p>Permissions: {{ json_encode(auth()->user()->getAllPermissions()->pluck('name')) }}</p>

                        <x-nav-link href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-users-gear"></i> Manage Users
                        </x-nav-link>
                    @else
                        <p class="text-red-500">You are NOT an admin</p>
                    @endif --}}


                    <x-nav-link href="/dashboard"> <i class="fa-solid fa-house"></i> Dashboard </x-nav-link>
                    <span class="mr-4">Role: <span
                            class="hover:text-laravel">{{ auth()->user()->roles[0]->name }}</span></span>

                    <!-- Logout Button -->
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                @else
                    <x-nav-link href="/register"> <i class="fa-solid fa-user-plus"></i> Register </x-nav-link>
                    <x-nav-link href="/login"> <i class="fa-solid fa-arrow-right-to-bracket"></i> Login </x-nav-link>
                @endauth
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
