<!-- resources/views/articles/create.blade.php -->

<x-app-layout>

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Crear Nuevo Artículo</h2>

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Título -->
        <div class="mb-4">
            <label for="titulo" class="block text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="w-full px-3 py-2 border rounded @error('titulo') border-red-500 @enderror" required>
            @error('titulo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contenido -->
        <div class="mb-4">
            <label for="contenido" class="block text-gray-700">Contenido</label>
            <textarea name="contenido" id="contenido" rows="5" class="w-full px-3 py-2 border rounded @error('contenido') border-red-500 @enderror" required>{{ old('contenido') }}</textarea>
            @error('contenido')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Categoría</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded @error('category_id') border-red-500 @enderror" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nombre }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Imagen -->
        <div class="mb-4">
            <label for="imagen" class="block text-gray-700">Imagen (Opcional)</label>
            <input type="file" name="imagen" id="imagen" class="w-full px-3 py-2 border rounded @error('imagen') border-red-500 @enderror" accept="image/*">
            @error('imagen')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('articles.index') }}" class="mr-4 text-gray-700 hover:underline">Cancelar</a>
            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Crear Artículo</button>
        </div>
    </form>
</div>
</x-app-layout>
