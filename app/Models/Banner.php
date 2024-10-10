<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'stt',
        'img',
        'content',
        'end_at',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
    
}