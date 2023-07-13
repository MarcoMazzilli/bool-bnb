<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    // Relazione con l'user
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Relazione con le immagini
    public function images(){
        return $this->hasMany(Image::class);
    }
    // Relazione con le visite
    public function visits(){
        return $this->hasMany(Visit::class);
    }
    // Relazione con i messaggi
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
