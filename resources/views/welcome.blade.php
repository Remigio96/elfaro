<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Faro</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <!-- Header -->
        <h1 class="text-4xl font-bold text-gray-800">Bienvenido a El Faro</h1>
        <p class="mt-2 text-lg text-gray-600">Descubre los mejores artículos seleccionados por nuestros autores.</p>

        <!-- Links para usuarios autenticados y no autenticados -->
        <div class="mt-6 space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Ir al Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Crear Cuenta
                </a>
            @endauth
        </div>
    </div>
</body>
</html>
