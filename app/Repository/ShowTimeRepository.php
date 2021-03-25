<?php


namespace App\Repository;
use App\Models\Showtime;
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
        return Showtime:: findOrFail($id);
    }

    public function storeShowTime(Showtime $showTime)
    {
        return $showTime->save();
    }

    public function updateShowTimeById(Showtime $oldShowTime, Showtime $update)
    {

    }

    public function deleteShowTimeById($id)
    {
        $showTime = Showtime::findOrFail($id);

        if($showTime) {
            $showTime->delete();
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => 'Show Time deleted successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Show Time',
            'message' => 'No Show Time Found',
            'data' => null
        ], 404);
    }
}
