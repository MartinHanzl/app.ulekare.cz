<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'name',
        'content',
        'priority',
    ];

    protected $casts = [
        'priority' => 'integer',
    ];
}
