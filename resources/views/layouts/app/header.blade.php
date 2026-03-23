<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

            <!-- search input -->
            <form method="GET" action="#" class="hidden lg:flex ms-4 flex-1">
                <input
                    type="text"
                    name="q"
                    placeholder="Buscar alumnos, docentes, grupos..."
                    class="w-full rounded-lg border border-zinc-300 bg-white py-2 px-3 text-sm placeholder-zinc-500 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:bg-zinc-800 dark:border-zinc-600 dark:placeholder-zinc-400"
                />
            </form>

            <flux:spacer />

            <!-- school year selector -->
            <div class="hidden lg:flex items-center space-x-1">
                <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">2024-2025</span>
                <flux:dropdown align="end">
                    <flux:dropdown.toggle class="h-8 w-8 rounded-full border border-zinc-300 flex items-center justify-center">
                        <x-heroicon-s-chevron-down class="w-4 h-4" />
                    </flux:dropdown.toggle>
                    <flux:dropdown.menu>
                        <flux:dropdown.item>2023-2024</flux:dropdown.item>
                        <flux:dropdown.item>2022-2023</flux:dropdown.item>
                    </flux:dropdown.menu>
                </flux:dropdown>
            </div>

            <!-- notifications & other icons -->
            <flux:navbar class="ms-4">
                <flux:tooltip :content="__('Notificaciones')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5 relative" href="#">
                        <x-heroicon-o-bell class="w-6 h-6" />
                        <span class="absolute top-0 right-0 inline-flex h-2 w-2 rounded-full bg-red-500" />
                    </flux:navbar.item>
                </flux:tooltip>
            </flux:navbar>

            <x-desktop-user-menu />
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')">
                    <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard')  }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
