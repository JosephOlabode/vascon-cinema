<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\IUser;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    private $userRepository = null;

    public function __construct(IUser $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return response()->json([
            'title' => 'VAS Users',
            'message' => (count($users) > 0) ? 'Users Available' : 'No User record found',
            'data' => $users
        ], (count($users) > 0) ? 200 : 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $savedUser = $this->userRepository->storeUser($user);

        return response()->json([
            'title' => 'VAS Users',
            'message' => ($savedUser != null) ? 'User saved successfully': 'User not saved',
            'data' => $savedUser
        ], ($savedUser != null));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);

        return response()->json([
            'title' => 'VAS Users',
            'message' => ($user != null) ? 'User record available': 'No user record found',
            'data' => $user
        ], ($user != null) ? 200 : 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $oldUser = $this->userRepository->getUserById($id);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        if($oldUser != null) {
            $updatedUser = $this->userRepository->updateUser($oldUser, $user);

            return response()->json([
                'title' => 'VAS Users',
                'message' => ($updatedUser != null) ? 'User updated successfully': 'User record not updated',
                'data' => $updatedUser
            ], ($updatedUser != null) ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Users',
                'message' => 'No User Found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // getting user by id
        $user = $this->userRepository->getUserById($id);


        if($user != null) {
            $deletedUser = $this->userRepository->deleteUser($user);
            return response()->json([
                'title' => 'VAS Users',
                'message' => ($deletedUser) ? 'User Deleted Successfully': 'Unable to Delete User',
                'data' => $deletedUser
            ], $deletedUser ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Users',
                'message' => 'No User found',
                'data' => null
            ], 404);
        }
    }
}
