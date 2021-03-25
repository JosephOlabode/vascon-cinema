<?php


namespace App\Repository;
use Validator;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesRepository implements IMovies
{
    public function getAllMovies()
    {
        return Movies::all();
    }

    public function getMovieById($id)
    {
       return Movies::findOrFail($id);
    }

    public function storeMovie(Movies $movie)
    {
        return $movie->save();
    }

    public function updateMovie(Movies $oldMovie, Movies $update)
    {
        $oldMovie->title = $update->title;
        $oldMovie->rating = $update->rating;
        $oldMovie->running_time = $update->running_time;
        $oldMovie->website = $update->website;
        $oldMovie->release_date = $update->release_date;
        $oldMovie->trailer = $update->trailer;
        $oldMovie->dvd_release = $update->dvd_release;
        $oldMovie->synopsys = $update->synopsys;

        return $oldMovie->save();
    }

    public function deleteMovie(Movies $movie)
    {
        return $movie->delete();
        /*$movie = Movies::findOrFail($id);

        if($movie) {
            $movie->delete();
            return response()->json([
                'title' => 'Vas Movies',
                'message' => 'Movie deleted successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Movies',
            'message' => 'No movie found',
            'data' => null
        ], 404);*/
    }
}
