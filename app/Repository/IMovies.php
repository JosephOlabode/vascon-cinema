<?php


namespace App\Repository;


Interface IMovies
{
    public function getAllMovies();
    public function getMovieById($id);
    public function storeMovie($movie);
    public function updateMovieById($movie, $id);
    public function deleteMovieById($id);
}
