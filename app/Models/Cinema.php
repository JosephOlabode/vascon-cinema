<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location'
    ];

    protected $guarded = [
        'id', 'createdAt', 'updatedAt'
    ];

    protected $hidden = [
        'createdAt', 'updatedAt'
    ];
}
