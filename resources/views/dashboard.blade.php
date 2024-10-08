<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bienvenida al usuario -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold">
                        Bienvenido, {{ Auth::user()->name }}!
                    </h3>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4">Artículos Recientes</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($articles as $article)
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <img class="w-full h-48 object-cover"
                                        src="{{ asset('storage/' . $article->imagen) }}" alt="{{ $article->titulo }}">
                                    <div class="p-4">
                                        <h4 class="text-lg font-bold mb-2">{{ $article->titulo }}</h4>
                                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit($article->contenido, 100) }}
                                        </p>

                                        <p class="text-sm text-gray-600">
                                            Categoría: <span
                                                class="font-semibold">{{ $article->category->nombre }}</span>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Autor: <span class="font-semibold">{{ $article->user->name }}</span>
                                        </p>

                                        <a href="{{ route('articles.show', $article) }}"
                                            class="mt-4 inline-block bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                                            Ver Artículo
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600">No hay artículos disponibles.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
