<!-- resources/views/articles/index.blade.php -->

<x-app-layout>

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Artículos</h1>
    <a href="{{ route('articles.create') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Crear Nuevo Artículo</a>
</div>

@if($articles->count())
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Título</th>
                    <th class="py-2 px-4 border-b">Categoría</th>
                    <th class="py-2 px-4 border-b">Autor</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $article->titulo }}</td>
                    <td class="py-2 px-4 border-b">{{ $article->category->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $article->user->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('articles.show', $article) }}" class="text-blue-500 hover:underline">Ver</a>
                        @if(Auth::id() === $article->user_id)
                            <a href="{{ route('articles.edit', $article) }}" class="text-yellow-500 hover:underline ml-4">Editar</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
@else
    <p class="text-center text-gray-500">No hay artículos disponibles.</p>
@endif
</x-app-layout>
