<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener artículos ordenados por fecha de creación
        $articles = Article::with('category', 'user')
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Pasar los artículos a la vista del dashboard
        return view('dashboard', compact('articles'));
    }
}
