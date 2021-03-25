<?php


namespace App\Repository;


use Illuminate\Http\Request;

Interface IUser
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByEmail($email);
    public function storeUser(Request $request);
    public function updateUser(Request $request, $id);
    public function deleteUser($id);
}
