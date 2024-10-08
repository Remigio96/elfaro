<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Mostrar el formulario de contacto.
     */
    public function create()
    {
        return view('contact.create'); // Asegúrate de que la vista existe
    }

    /**
     * Almacenar un nuevo mensaje de contacto en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Asignar el ID del usuario autenticado si está disponible
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        // Renombrar las claves del arreglo de validación para almacenarlas correctamente
        $contactMessageData = [
            'nombre' => $data['name'],
            'email' => $data['email'],
            'asunto' => $data['subject'],
            'mensaje' => $data['message'],
            'user_id' => $data['user_id'] ?? null,
        ];

        // Crear el mensaje de contacto
        $contactMessage = ContactMessage::create($contactMessageData);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('contact.create')->with('success', 'Mensaje de contacto enviado exitosamente.');
    }
}
