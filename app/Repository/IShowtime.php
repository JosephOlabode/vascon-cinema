<?php


namespace App\Repository;


Interface IShowtime
{
    public function getAllShowTime();
    public function getShowTimeById($id);
    public function storeShowTime($showTime);
    public function updateShowTimeById($showTime, $id);
    public function deleteShowTimeById($id);
}
