<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
        'address',
        'address_info',
        'coordinate',
        'price',
        'n_of_bed',
        'n_of_room',
        'n_of_bathroom',
        'apartment_size',
        'visible',
        'type'
    ];
}
