<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'date', 'startTime', 'endTime',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'update_at'
    ];

    /*public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function movie() {
        return $this->belongsTo(Movies::class);
    }*/

    public function cinema() {
        return $this->belongsToMany(
            Cinema::class,
            'showtime',
            'movie_id',
            'cinema_id'
        )->withPivot(['date', 'start_time', 'end_time'])->withTimestamps();
    }

    public function movie() {
        return $this->belongsToMany(
            Movies::class,
            'showtime',
            'movie_id',
            'cinema_id'
        )->withPivot(['date', 'start_time', 'end_time'])->withTimestamps();
    }
}
