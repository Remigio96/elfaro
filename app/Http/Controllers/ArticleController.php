<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Constructor para aplicar middleware de autenticación.
     */
    public function __construct()
    {
        // Solo los usuarios autenticados pueden crear, editar, actualizar y eliminar artículos
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Mostrar una lista de los artículos.
     */
    public function index()
    {
        // Obtener los artículos con las relaciones necesarias
        $articles = Article::with(['user', 'category'])->latest()->paginate(10);
        
        // Retornar la vista con los artículos
        return view('articles.index', compact('articles'));
    }

    /**
     * Mostrar el formulario para crear un nuevo artículo.
     */
    public function create()
    {
        // Obtener todas las categorías para el formulario
        $categories = Category::all();
        
        // Retornar la vista de creación de artículo
        return view('articles.create', compact('categories'));
    }
    
    /**
     * Almacenar un nuevo artículo en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Manejar la subida de la imagen si existe
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }
    
        // Asignar el ID del usuario autenticado
        $data['user_id'] = Auth::id();
    
        // Crear el artículo
        $article = Article::create($data);
    
        // Redirigir a la lista de artículos con un mensaje de éxito
        return redirect()->route('articles.index')->with('success', 'Artículo creado exitosamente.');
    }

    /**
     * Mostrar un artículo específico.
     */
    public function show(Article $article)
    {
        // Cargar las relaciones necesarias
        $article->load(['user', 'category']);
        
        // Retornar la vista con el artículo
        return view('articles.show', compact('article'));
    }

    /**
     * Mostrar el formulario para editar un artículo específico.
     */
    public function edit(Article $article)
    {
        // Verificar si el usuario autenticado es el propietario del artículo
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'No autorizado.');
        }
    
        // Obtener todas las categorías para el formulario
        $categories = Category::all();
        
        // Retornar la vista de edición de artículo
        return view('articles.edit', compact('article', 'categories'));
    }
    

    /**
     * Actualizar un artículo específico en la base de datos.
     */
    public function update(Request $request, Article $article)
    {
        // Verificar si el usuario autenticado es el propietario del artículo
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'No autorizado.');
        }
    
        // Validar los datos de entrada
        $data = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'contenido' => 'sometimes|required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);
    
        // Manejar la subida de la imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($article->imagen) {
                Storage::disk('public')->delete($article->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }
    
        // Actualizar el artículo
        $article->update($data);
    
        // Redirigir a la vista del artículo con un mensaje de éxito
        return redirect()->route('articles.show', $article)->with('success', 'Artículo actualizado exitosamente.');
    }

    /**
     * Eliminar un artículo específico de la base de datos.
     */
    public function destroy(Article $article)
    {
        // Verificar si el usuario autenticado es el propietario del artículo
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')->with('error', 'No autorizado.');
        }
    
        // Eliminar la imagen si existe
        if ($article->imagen) {
            Storage::disk('public')->delete($article->imagen);
        }
    
        // Eliminar el artículo
        $article->delete();
    
        // Redirigir a la lista de artículos con un mensaje de éxito
        return redirect()->route('articles.index')->with('success', 'Artículo eliminado exitosamente.');
    }
}
