<!-- resources/views/categories/index.blade.php -->

<x-app-layout>

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Categorías</h1>
    <a href="{{ route('categories.create') }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Crear Nueva Categoría</a>
</div>

@if($categories->count())
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $category->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->descripcion }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('categories.show', $category) }}" class="text-blue-500 hover:underline">Ver</a>
                        <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 hover:underline ml-4">Editar</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
@else
    <p class="text-center text-gray-500">No hay categorías disponibles.</p>
@endif
</x-app-layout>
