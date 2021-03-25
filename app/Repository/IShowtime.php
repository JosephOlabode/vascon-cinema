<?php


namespace App\Repository;


use App\Models\Showtime;
use Illuminate\Http\Request;

Interface IShowtime
{
    public function getAllShowTime();
    public function getShowTimeById($id);
    public function storeShowTime(Showtime $showtime);
    public function updateShowTime(Showtime $oldShowTime, Showtime $update);
    public function deleteShowTime(Showtime $showtime);
}
