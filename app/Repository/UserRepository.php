<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;

class UserRepository implements IUser
{

    public function getAllUsers()
    {
        $users = User::all();

        if($users->count() > 0) {
            return response()->json([
                'title' => 'Vas Users',
                'message' => 'Users available',
                'data' => $users
            ]);
        }

        return response()->json([
            'title' => 'Vas Users',
            'message' => 'No User record found',
            'data' => []
        ]);
    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);

        if($user) {
            return response()->json([
                'title' => 'Vas Users',
                'message' => 'User available',
                'data' => $user
            ]);
        }

        return response()->json([
            'title' => 'Vas Users',
            'message' => 'No User Found',
            'data' => null
        ]);
    }

    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if($user) {
            return response()->json([
                'title' => 'Vas Users',
                'message' => 'User available',
                'data' => $user
            ]);
        }

        return response()->json([
            'title' => 'Vas Users',
            'message' => 'No User Found',
            'data' => null
        ]);
    }

    public function storeUser(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Users',
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
        return response()->json([
            'title' => 'Vas Users',
            'message' => 'User saved successfully',
            'data' => []
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Users',
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        $user = User::findOrFail($id);
        if($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');

            $user->save();
            return response()->json([
                'title' => 'Vas Users',
                'message' => 'User updated successfully',
                'data' => []
            ]);
        }

        return response()->json([
            'title' => 'Vas Users',
            'message' => 'No User Found',
            'data' => []
        ], 404);

    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if($user) {
            $user->delete();
            return response()->json([
                'title' => 'Vas Users',
                'message' => 'User deleted successfully',
                'data' => null
            ]);
        }

        return response()->json([
            'title' => 'Vas Users',
            'message' => 'No User Found',
            'data' => null
        ], 404);
    }
}
