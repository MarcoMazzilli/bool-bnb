<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

            // Relazione con l'appartamento
            public function apartment(){
                return $this->belongsTo(Apartment::class);
            }


    protected $fillable = [
        'ip_address',
        'date'
    ];

}
