<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'venue',
        'price',
        'capacity',
        'image',
    ];

    // Relación: un evento tiene muchos tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Helper para saber si quedan boletos disponibles
    public function availableTickets()
    {
        return $this->capacity - $this->tickets()->count();
    }
}