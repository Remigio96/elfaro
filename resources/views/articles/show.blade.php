<!-- resources/views/articles/show.blade.php -->

<x-app-layout>

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $article->titulo }}</h2>

    <!-- Imagen del Artículo (si existe) -->
    @if($article->imagen)
        <img src="{{ asset('storage/' . $article->imagen) }}" alt="{{ $article->titulo }}" class="w-full h-auto mb-4 rounded">
    @endif

    <p class="text-gray-700 mb-4">{{ $article->contenido }}</p>

    <p class="text-sm text-gray-500">Categoría: {{ $article->category->nombre }}</p>
    <p class="text-sm text-gray-500">Autor: {{ $article->user->name }}</p>
    <p class="text-sm text-gray-500">Creado el: {{ $article->created_at->format('d/m/Y H:i') }}</p>

    @if(Auth::id() === $article->user_id)
        <div class="mt-6 flex">
            <a href="{{ route('articles.edit', $article) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="ml-4" onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</button>
            </form>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('articles.index') }}" class="text-indigo-500 hover:underline">← Volver a la lista de artículos</a>
    </div>
</div>
</x-app-layout>
