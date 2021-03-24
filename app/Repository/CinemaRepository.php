<?php


namespace App\Repository;


use App\Models\Cinema;

class CinemaRepository implements ICinema
{
    public function getAllCinema()
    {
        $cinemas = Cinema::all();

        if($cinemas->count() !== 0) {
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
}
