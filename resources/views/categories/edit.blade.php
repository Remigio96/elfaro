<!-- resources/views/categories/edit.blade.php -->

<x-app-layout>

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Editar Categoría</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $category->nombre) }}" class="w-full px-3 py-2 border rounded @error('nombre') border-red-500 @enderror" required>
            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700">Descripción (Opcional)</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="w-full px-3 py-2 border rounded @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $category->descripcion) }}</textarea>
            @error('descripcion')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('categories.show', $category) }}" class="mr-4 text-gray-700 hover:underline">Cancelar</a>
            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Actualizar Categoría</button>
        </div>
    </form>
</div>
</x-app-layout>
