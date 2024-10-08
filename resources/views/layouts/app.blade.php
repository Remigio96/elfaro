<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Faro</title>
    <!-- Vite - Tailwind CSS y JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900"> <!-- Agrega soporte para el modo oscuro -->

    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 dark:text-white">El
                                Faro</a>
                        </div>
                        <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-200">
                                Home
                            </a>
                            <a href="{{ route('articles.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-200">
                                Artículos
                            </a>
                            <a href="{{ route('categories.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-200">
                                Categorías
                            </a>
                            <a href="{{ route('contact.create') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:border-indigo-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-200">
                                Contacto
                            </a>
                        </div>
                    </div>

                    <!-- Botón de alternancia de tema -->
                    <div class="flex items-center">
                        <button id="theme-toggle" class="focus:outline-none text-gray-500 dark:text-gray-300">
                            <!-- Icono modo claro (sol) -->
                            <svg id="theme-toggle-light-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>

                            <!-- Icono modo oscuro (luna) -->
                            <svg id="theme-toggle-dark-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <!-- Authentication Links -->
                        @auth
                            <div class="ml-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('storage/imagenes/default-avatar.png') }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Perfil') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-700 dark:text-gray-300 underline">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 text-sm text-gray-700 dark:text-gray-300 underline">Registrarse</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 text-center py-4">
            <p class="text-gray-500 dark:text-gray-400">&copy; El Faro News. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>

</html>
