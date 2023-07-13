<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'object',
        'text',
        'author_email',
        'message_read',
        'author_first_name',
        'author_last_name',
    ];
}
