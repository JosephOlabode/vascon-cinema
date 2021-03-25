<?php


namespace App\Repository;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Validator;

class ShowTimeRepository implements IShowtime
{

    public function getAllShowTime()
    {
        $showTime = Showtime::all();

        if($showTime->count() > 0) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => 'Show Time are available',
                'data' => $showTime
            ]);
        }

        return response()->json([
            'title' => 'Vas Show Time',
            'message' => 'No show time was gotten',
            'data' => null
        ], 404);
    }

    public function getShowTimeById($id)
    {
        $showTime = Showtime:: findOrFail($id);
        if($showTime) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => 'Show Time is available',
                'data' => $showTime
            ]);
        }
        return response()->json([
            'title' => 'Vas Show Time',
            'message' => 'No Show Time Found',
            'data' => null
        ], 404);
    }

    public function storeShowTime($request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $showTime = new Showtime();
        $showTime->date = $request->input('date');
        $showTime->start_time = $request->input('startTime');
        $showTime->end_time = $request->input('endTime');

        $showTime->save();

        return response()->json([
            'title' => 'Vas Show Time',
            'message' => 'Show Time Saved Successfully',
            'data' => []
        ]);
    }

    public function updateShowTimeById($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $showTime = Showtime::findOrFail($id);
        if($showTime) {
            $showTime->date = $request->input('date');
            $showTime->start_time = $request->input('startTime');
            $showTime->end_time = $request->input('endTime');

            $showTime->save();

            return response()->json([
                'title' => 'Vas Show Time',
                'message' => 'Show Time updated Successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Show Time',
            'message' => 'No show time Found',
            'data' => null
        ], 404);

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
