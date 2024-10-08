<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Constructor para aplicar middleware de autenticación.
     */
    public function __construct()
    {
        // Solo los usuarios autenticados pueden crear, editar, actualizar y eliminar categorías
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Mostrar una lista de las categorías.
     */
    public function index()
    {
        // Obtener las categorías y paginarlas
        $categories = Category::latest()->paginate(10);

        // Retornar la vista con las categorías
        return view('categories.index', compact('categories'));
    }

    /**
     * Mostrar el formulario para crear una nueva categoría.
     */
    public function create()
    {
        // Retornar la vista del formulario para crear una nueva categoría
        return view('categories.create');
    }

    /**
     * Almacenar una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Crear la categoría
        Category::create($data);

        // Redirigir a la página de listado de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Mostrar una categoría específica.
     */
    public function show(Category $category)
    {
        // Cargar los artículos relacionados con la categoría
        $category->load('articles');

        // Retornar la vista con los detalles de la categoría
        return view('categories.show', compact('category'));
    }

    /**
     * Mostrar el formulario para editar una categoría específica.
     */
    public function edit(Category $category)
    {
        // Retornar la vista del formulario para editar la categoría
        return view('categories.edit', compact('category'));
    }

    /**
     * Actualizar una categoría específica en la base de datos.
     */
    public function update(Request $request, Category $category)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        // Actualizar la categoría
        $category->update($data);

        // Redirigir a la página de listado de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Eliminar una categoría específica de la base de datos.
     */
    public function destroy(Category $category)
    {
        // Verificar si hay artículos asociados
        if ($category->articles()->count()) {
            return redirect()->route('categories.index')->with('error', 'No se puede eliminar una categoría con artículos asociados.');
        }

        // Eliminar la categoría
        $category->delete();

        // Redirigir a la página de listado de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
