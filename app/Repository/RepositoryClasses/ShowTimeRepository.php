<?php


namespace App\Repository\RepositoryClasses;
use App\Models\Showtime;
use App\Repository\RepositoryInterfaces\IShowtime;
use Illuminate\Http\Request;
use Validator;

class ShowTimeRepository implements IShowtime
{

    public function getAllShowTime()
    {
        return Showtime::all();
    }

    public function getShowTimeById($id)
    {
        return Showtime:: find($id);
    }

    public function storeShowTime(Showtime $showTime)
    {
        return $showTime->save();
    }

    public function updateShowTime(Showtime $oldShowTime, Showtime $update)
    {
        $oldShowTime->date = $update->date;
        $oldShowTime->start_time = $update->start_time;
        $oldShowTime->end_time = $update->end_time;

        return $oldShowTime->save();
    }

    public function deleteShowTime($showtime)
    {
        return $showtime->delete();
    }
}
