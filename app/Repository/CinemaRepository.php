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


    public function getCinemaById($id)
    {
        // TODO: Implement getCinemaById() method.
    }

    public function storeCinema($cinema)
    {
        // TODO: Implement storeCinema() method.
    }

    public function updateCinemaById($cinema, $id)
    {
        // TODO: Implement updateCinemaById() method.
    }

    public function deleteCinemaById($id)
    {
        // TODO: Implement deleteCinemaById() method.
    }
}
