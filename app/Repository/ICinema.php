<?php


namespace App\Repository;


Interface ICinema
{
    public function getAllCinema();
    public function getCinemaById($id);
    public function storeCinema($cinema);
    public function updateCinemaById($cinema, $id);
    public function deleteCinemaById($id);
}
