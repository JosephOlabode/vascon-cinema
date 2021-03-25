<?php


namespace App\Repository;
use Validator;

use App\Models\Movies;
use Illuminate\Http\Request;

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
        ], 404);
    }

    public function getMovieById($id)
    {
        $movie = Movies::findOrFail($id);
        if($movie) {
            return response()->json([
                'title' => 'Vas Movies',
                'message' => 'Movie is available',
                'data' => $movie
            ]);
        }

        return response()->json([
            'title' => 'Vas Movies',
            'message' => 'No movie found',
            'data' => null
        ]);
    }

    public function storeMovie($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'rating' => 'required',
            'runningTime' => 'required',
            'website' => 'required',
            'releaseDate' => 'required',
            'trailer' => 'required',
            'dvdRelease' => 'required',
            'synopsys' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Movies',
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        $movie = new Movies();
        $movie->title = $request->input('title');
        $movie->rating = $request->input('rating');
        $movie->running_time = $request->input('runningTime');
        $movie->website = $request->input('website');
        $movie->release_date = $request->input('release_date');
        $movie->trailer = $request->input('trailer');
        $movie->dvd_release = $request->input('dvdRelease');
        $movie->synopsys = $request->input('synopsys');
        $movie->save();

        return response()->json([
            'title' => 'Vas Movies',
            'message' => 'Movie stored successfully',
            'data' => []
        ]);
    }

    public function updateMovieById($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'rating' => 'required',
            'runningTime' => 'required',
            'website' => 'required',
            'releaseDate' => 'required',
            'trailer' => 'required',
            'dvdRelease' => 'required',
            'synopsys' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Movies',
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        $movie = Movies::findOrFail($id);
        if($movie == null) {
            return response()->json([
                'title' => 'Vas Movies',
                'message' => 'No movie found',
                'data' => null
            ], 404);
        }
        $movie->title = $request->input('title');
        $movie->rating = $request->input('rating');
        $movie->running_time = $request->input('runningTime');
        $movie->website = $request->input('website');
        $movie->release_date = $request->input('release_date');
        $movie->trailer = $request->input('trailer');
        $movie->dvd_release = $request->input('dvdRelease');
        $movie->synopsys = $request->input('synopsys');

        $movie->save();
        return response()->json([
            'title' => 'Vas Movies',
            'message' => 'Movie updated successfully',
            'data' => []
        ]);
    }

    public function deleteMovieById($id)
    {
        $movie = Movies::findOrFail($id);
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
        ], 404);
    }
}
