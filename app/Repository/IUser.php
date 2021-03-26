<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;

Interface IUser
{
    public function getAllUsers();
    public function getUserById($id);
    public function getUserByEmail($email);
    public function storeUser(User $user);
    public function updateUser(User $oldUser, User $update);
    public function deleteUser(User $user);
}
