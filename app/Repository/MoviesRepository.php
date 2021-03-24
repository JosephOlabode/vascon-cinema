<?php


namespace App\Repository;


use App\Models\Movies;

class MoviesRepository implements IMovies
{
    public function getAllMovies()
    {
        $movies = Movies::all();

        if($movies->count() == 0) {
            return response()->json([
                'title' => 'Vas Movies',
                'message' => 'No movie is available',
                'data' => []
            ]);
        }

        return response()->json([
            'title'=> 'Vas Movies',
            'message' => 'Movies are available',
            'data' => $movies
        ]);
    }
}
