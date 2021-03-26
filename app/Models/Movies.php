<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'rating', 'runningTime', 'website', 'releaseDate', 'trailer', 'dvdRelease', 'synopsys'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function showTime() {
        return $this->hasMany(Showtime::class);
    }

}
