<?php


namespace App\Repository;


use App\Models\Cinema;

class CinemaRepository implements ICinema
{
    public function getAllCinema()
    {
        return Cinema::all();
    }


    public function getCinemaById($id)
    {
       return Cinema::findOrFail($id);
    }

    public function storeCinema($cinema)
    {
        return $cinema->save();

    }

    public function updateCinema(Cinema $oldCinema, Cinema $update)
    {
        $oldCinema->name = $update->name;
        $oldCinema->location = $update->location;

        return $oldCinema->save();
    }

    public function deleteCinema($cinema)
    {
        return $cinema->delete();
    }
}
