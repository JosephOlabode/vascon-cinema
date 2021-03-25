<?php


namespace App\Repository;


use App\Models\Cinema;
use Validator;

class CinemaRepository implements ICinema
{
    public function getAllCinema()
    {
        $cinemas = Cinema::all();

        if($cinemas->count() > 0) {
            return response()->json([
                'title' => 'Vas Cinemas',
                'message' => 'Cinemas are available',
                'data' => $cinemas
            ]);
        }

        return response()->json([
            'title' => 'Vas Cinemas',
            'message' => 'No Cinema was gotten',
            'data' => null
        ]);
    }


    public function getCinemaById($id)
    {
        $cinema = Cinema::findOrFail($id);

        if($cinema) {
            return response()->json([
                'title' => 'Vas Cinema',
                'message' => 'Cinema is available',
                'data' => $cinema
            ]);
        }

        return response()->json([
            'title' => 'Vas Cinema',
            'message' => 'No Cinema Found',
            'data' => null
        ], 404);
    }

    public function storeCinema($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Cinema',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $cinema = new Cinema();
        $cinema->name = $request->input('name');
        $cinema->location = $request->input('location');

        $cinema->save();

        return response()->json([
            'title' => 'Vas Cinema',
            'message' => 'Cinema Saved Successfully',
            'data' => null
        ]);
    }

    public function updateCinemaById($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Cinema',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $cinema = Cinema::findOrFail($id);

        if($cinema) {
            $cinema->name = $request->input('name');
            $cinema->location = $request->input('location');

            $cinema->save();

            return response()->json([
                'title' => 'Vas Cinema',
                'message' => 'Cinema updated Successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Cinema',
            'message' => 'No Cinema Found',
            'data' => null
        ]);

    }

    public function deleteCinemaById($id)
    {
        $cinema = Cinema::findOrFail($id);

        if($cinema) {
            $cinema->delete();
            return response()->json([
                'title' => 'Vas Cinema',
                'message' => 'Cinema deleted successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Cinema',
            'message' => 'No Cinema Found',
            'data' => null
        ], 404);
    }
}
