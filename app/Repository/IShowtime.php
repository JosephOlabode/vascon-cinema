<?php


namespace App\Repository;


use Illuminate\Http\Request;

Interface IShowtime
{
    public function getAllShowTime();
    public function getShowTimeById($id);
    public function storeShowTime(Request $request);
    public function updateShowTimeById(Request $request, $id);
    public function deleteShowTimeById($id);
}
