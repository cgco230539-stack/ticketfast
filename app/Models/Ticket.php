<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'unique_code',
        'status',
    ];

    // Relación: un ticket pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un ticket pertenece a un evento
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}