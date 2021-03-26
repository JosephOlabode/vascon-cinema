<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Repository\RepositoryInterfaces\IMovies;
use Illuminate\Http\Request;
use Validator;

class MoviesController extends Controller
{
    private $movieRepository = null;
    public function __construct(IMovies $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $movies = $this->movieRepository->getAllMovies();

        return response()->json([
            'title' => 'VAS Movies',
            'message' => (count($movies) > 0) ? 'Movies are available' :  'No movie record available',
            'data' => $movies
        ], (count($movies) > 0) ? 200: 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $storedMovie = $this->movieRepository->storeMovie($movie);

        return response()->json([
            'title' => 'VAS Movies',
            'message' => ($storedMovie != null) ? 'Movie stored successfully' : 'Not stored',
            'data' => $storedMovie
        ],  ($storedMovie != null) ? 200 : 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movieRepository->getMovieById($id);

        return response()->json([
            'title' => 'VAS Movies',
            'message' => ($movie == null)? 'No movie is found' : 'Movie available',
            'data' => $movie
        ], ($movie == null)? 404 : 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        // getting movie by id
        $oldMovie = $this->movieRepository->getMovieById($id);

        // creating the movie object from the request
        $movie = new Movies();
        $movie->title = $request->input('title');
        $movie->rating = $request->input('rating');
        $movie->running_time = $request->input('runningTime');
        $movie->website = $request->input('website');
        $movie->release_date = $request->input('releaseDate');
        $movie->trailer = $request->input('trailer');
        $movie->dvd_release = $request->input('dvdRelease');
        $movie->synopsys = $request->input('synopsys');

        if($oldMovie != null) {
            $updatedMovie = $this->movieRepository->updateMovie($oldMovie, $movie);
            return response()->json([
                'title' => 'VAS Movies',
                'message' => ($updatedMovie != null) ? 'Movie updated successfully' : 'Update was not successful',
                'data' => $updatedMovie
            ], ($updatedMovie != null) ? 200 : 422);
        } else {
            return response()->json([
                'title' => 'VAS Movies',
                'message' => 'No Movie was found',
                'data' => null
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // getting movie by id
        $movie = $this->movieRepository->getMovieById($id);

        if($movie != null) {
            $deletedMovie = $this->movieRepository->deleteMovie($movie);
            return response()->json([
                'title' => 'VAS Movies',
                'message' => ($deletedMovie) ? 'Movie Deleted Successfully': 'Unable to Delete Movie',
                'data' => $deletedMovie
            ], $deletedMovie ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Movies',
                'message' => 'No movie found',
                'data' => null
            ], 404);
        }
    }
}
