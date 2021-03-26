<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;

class UserRepository implements IUser
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function getUserByEmail($email)
    {
       return User::where('email', $email)->first();
    }

    public function storeUser(User $user)
    {
        return $user->save();
    }

    public function updateUser(User $oldUser, User $update)
    {
        $oldUser->name = $update->name;
        $oldUser->email = $update->email;
        $oldUser->password = $update->password;

        return $oldUser->save();

    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}
