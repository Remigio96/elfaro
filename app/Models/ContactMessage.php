<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'asunto', 'mensaje', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}