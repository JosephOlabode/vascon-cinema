<?php


namespace App\Repository;


use App\Models\Cinema;
use Illuminate\Http\Request;

Interface ICinema
{
    public function getAllCinema();
    public function getCinemaById($id);
    public function storeCinema(Cinema $cinema);
    public function updateCinema(Cinema $oldCinema, Cinema $update);
    public function deleteCinema(Cinema $cinema);
}
