<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Añadir esta línea
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Importa las clases necesarias
use App\Models\Article;
use App\Models\ContactMessage;

class User extends Authenticatable implements MustVerifyEmail // Implementar la interfaz MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación uno a muchos con Article.
     * Un usuario puede tener muchos artículos.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relación uno a muchos con ContactMessage.
     * Un usuario puede tener muchos mensajes de contacto.
     */
    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}
