<?php


namespace App\Repository;


Interface ICinema
{
    public function getAllCinema();
    public function getMovieById($id);
    public function storeMovie($movie);
    public function updateMovieById($movie, $id);
    public function deleteMovieById($id);
}
