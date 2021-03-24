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

    public function getMovieById($id)
    {
        // TODO: Implement getMovieById() method.
    }

    public function storeMovie($movie)
    {
        // TODO: Implement storeMovie() method.
    }

    public function updateMovieById($movie, $id)
    {
        // TODO: Implement updateMovieById() method.
    }

    public function deleteMovieById($id)
    {
        // TODO: Implement deleteMovieById() method.
    }
}
