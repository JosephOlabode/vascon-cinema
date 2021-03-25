<?php


namespace App\Repository;


use Illuminate\Http\Request;

Interface ICinema
{
    public function getAllCinema();
    public function getCinemaById($id);
    public function storeCinema(Request $request);
    public function updateCinemaById(Request $request, $id);
    public function deleteCinemaById($id);
}
