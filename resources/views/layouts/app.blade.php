<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="wireframe">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">


    <!-- Main Layout -->
    <x-mary-main full-width>

        <!-- Sidebar Navigation -->
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100">
            <!-- Brand Logo -->
            <div class="flex items-center p-4">
                <a href="{{ route('dashboard') }}">
                    <div class="flex gap-2 aling-item-center">
                        <x-application-mark class="block w-auto h-9" />
                        <p class="font-bold">App</p>
                    </div>
                </a>
            </div>

            <!-- Menu -->
            <x-mary-menu activate-by-route>
                <!-- Navigation Links -->
                <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('dashboard') }}" />
                <x-mary-menu-item title="Books" icon="o-book-open" link="{{ route('books.index') }}" />
                <x-mary-menu-item title="Upload" icon="o-arrow-up-tray" link="{{ route('highlights.upload') }}" />


                <!-- User Section -->
                @auth
                    <x-mary-menu-separator />

                    <!-- User Profile -->
                    <x-mary-list-item :item="Auth::user()" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <x-slot:avatar>
                                <img class="rounded-full size-10" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </x-slot:avatar>
                        @endif
                        <x-slot:actions>
                            <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                no-wire-navigate link="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </x-slot:actions>
                    </x-mary-list-item>

                    <x-mary-menu-separator />

                    <!-- Account Management -->
                    <x-mary-menu-sub title="Account" icon="o-user">
                        <x-mary-menu-item title="Profile" icon="o-user-circle" link="{{ route('profile.show') }}" />
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-mary-menu-item title="API Tokens" icon="o-key" link="{{ route('api-tokens.index') }}" />
                        @endif
                    </x-mary-menu-sub>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <x-mary-menu-sub title="Team" icon="o-user-group">
                            <x-mary-menu-item title="Team Settings" icon="o-cog-6-tooth"
                                link="{{ route('teams.show', Auth::user()->currentTeam->id) }}" />
                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-mary-menu-item title="Create Team" icon="o-plus-circle"
                                    link="{{ route('teams.create') }}" />
                            @endcan

                            <!-- Team Switcher -->
                            @if (Auth::user()->allTeams()->count() > 1)
                                <x-mary-menu-separator />
                                <div class="px-4 py-2 text-xs text-gray-500">Switch Teams</div>
                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-mary-form method="post" action="{{ route('current-team.update') }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="team_id" value="{{ $team->id }}">
                                        <x-mary-menu-item title="{{ $team->name }}" icon="o-arrow-right-circle"
                                            type="submit" :active="Auth::user()->isCurrentTeam($team)" />
                                    </x-mary-form>
                                @endforeach
                            @endif
                        </x-mary-menu-sub>
                    @endif

                    <!-- Theme Toggle -->
                    <div class="px-4 py-2">
                        <x-mary-theme-toggle darkTheme="dracula" lightTheme="cupcake" />
                    </div>
                @endauth
            </x-mary-menu>
        </x-slot:sidebar>

        <!-- Content Area -->
        <x-slot:content class="w-full">

            <x-mary-card>
                @if (isset($header))
                    <x-mary-header :title="$header" :subtitle="$subtitle ?? null" separator class="font-serif " />
                @endif
                {{ $slot }}
            </x-mary-card>

        </x-slot:content>

    </x-mary-main>
    <!-- Mobile Navigation -->
    <x-mary-nav sticky class="fixed mx-5 shadow-2xl bottom-2 rounded-2xl lg:hidden bg-base-200 ">
        <x-slot:actions class="grid h-full max-w-lg grid-cols-5 mx-auto">

             <a href="{{ route('dashboard') }}" class="inline-flex flex-col items-center justify-center hover:bg-gray-50 group">
                    <x-heroicon-o-home class="w-6 h-6 text-gray-500 hover:text-gray-50 " />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ">Home</span>
                </a>
             <a href="{{ route('books.index') }}" class="inline-flex flex-col items-center justify-center hover:bg-gray-50 group">
                    <x-heroicon-o-book-open class="w-6 h-6 text-gray-500 hover:text-gray-50 " />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ">Books</span>
                </a>
              <a href="{{ route('dashboard') }}" class="inline-flex flex-col items-center justify-center">
                    <x-heroicon-o-heart class="w-6 h-6 text-gray-500 hover:text-gray-50" />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ">Favorite</span>
                </a>
               <a href="{{ route('highlights.upload') }}" class="inline-flex flex-col items-center justify-center">
                    <x-heroicon-o-arrow-up-tray class="w-6 h-6 text-gray-500 hover:text-gray-50" />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ">Upload</span>
                </a>
                <a href="{{ route('profile.show') }}" class="inline-flex flex-col items-center justify-center">
                    <x-heroicon-o-user-circle class="w-6 h-6 text-gray-500 hover:text-gray-50" />
                    <span class="text-sm text-gray-500 dark:text-gray-400 ">Profile</span>
                </a>


        </x-slot:actions>
        {{-- <x-slot:brand>
                <label for="main-drawer" class="mr-3 lg:hidden">
                    <x-heroicon-o-bars-3 class="w-6 h-6 text-gray-500"/>
                </label>

            </x-slot:brand> --}}

    </x-mary-nav>


    @stack('modals')
    @livewireScripts
    <x-mary-toast />
    <x-mary-spotlight />
</body>

</html>
