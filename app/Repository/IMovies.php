<?php


namespace App\Repository;


use Illuminate\Http\Request;

Interface IMovies
{
    public function getAllMovies();
    public function getMovieById($id);
    public function storeMovie(Request $request);
    public function updateMovieById(Request $request, $id);
    public function deleteMovieById($id);
}
