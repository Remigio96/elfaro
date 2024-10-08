<!-- resources/views/categories/show.blade.php -->

<x-app-layout>

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ $category->nombre }}</h2>

    @if($category->descripcion)
        <p class="text-gray-700 mb-4">{{ $category->descripcion }}</p>
    @endif

    <h3 class="text-xl font-semibold mb-2">Artículos en esta Categoría</h3>

    @if($category->articles->count())
        <ul class="list-disc list-inside">
            @foreach($category->articles as $article)
                <li>
                    <a href="{{ route('articles.show', $article) }}" class="text-blue-500 hover:underline">{{ $article->titulo }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">No hay artículos en esta categoría.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('categories.index') }}" class="text-indigo-500 hover:underline">← Volver a la lista de categorías</a>
    </div>
</div>
</x-app-layout>
