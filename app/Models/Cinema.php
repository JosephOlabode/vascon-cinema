<?php

namespace App\Models;

use App\Http\Controllers\ShowTimeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /*public function showTime()
    {
        return $this->hasMany(Showtime::class);
    }*/

    public function showTime() {
        return $this->belongsToMany(
            Showtime::class,
            'showtime',
            'cinema_id',
            'movie_id'
        )->withPivot(['date', 'start_time', 'end_time'])->withTimestamps();
    }
}
