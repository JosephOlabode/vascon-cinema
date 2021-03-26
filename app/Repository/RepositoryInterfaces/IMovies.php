<?php


namespace App\Repository\RepositoryInterfaces;


use App\Models\Movies;
use Illuminate\Http\Request;

Interface IMovies
{
    public function getAllMovies();
    public function getMovieById($id);
    public function storeMovie(Movies $movies);
    public function updateMovie(Movies $oldMovie, Movies $update);
    public function deleteMovie(Movies $movie);
}
