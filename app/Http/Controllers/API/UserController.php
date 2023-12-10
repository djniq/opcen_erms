<?php

namespace App\Http\Controllers\API;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function list() {
        $users = User::select([
            "id",
            "health_facility_id",
            "first_name as firstName",
            "last_name as lastName",
            "middle_name as middleName",
            "role",
            "email",
            "contact_no as contactNo",
            "status",
            "created_at as createdAt",
            "created_by as createdBy"
        ])->with('healthFacility:id,hf_name')->get();
        $users = $users->each(function($item, $key){
            $item->contactNoFull = '+63' . $item->contactNo;
            $item->roleLabel = $item->getRole($item->role);
            $item->statusLabel = $item->getStatus($item->status);
            $item->healthFacilityId = $item->healthFacility->id;
            unset($item->health_facility_id);
            $item->healthFacilityName = $item->healthFacility->hf_name;
            unset($item->healthFacility);
        });
        return UserResource::collection($users);
    }

    /**
     * Register
     */
    public function create(Request $request)
    {
        try {
            $user = new User();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->middle_name = $request->middleName;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->contact_no = $request->contactNo;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->health_facility_id = $request->healthFacilityId;
            $user->save();

            $success = true;
            $message = 'New User Created';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
        } else {
            $success = false;
            $message = 'Login failed. Please check your username or password.';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $userId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId)
    {
        $user = user::find($userId);
        try {
            $user->update($request->all());

            $success = true;
            $message = 'User record updated';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            "success" => $success,
            "message" => $message,
            "data" => $user ?? null
        ];
        
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $userId)
    {
        $user = User::find($userId);
        $user->delete();

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id));
    }
}
