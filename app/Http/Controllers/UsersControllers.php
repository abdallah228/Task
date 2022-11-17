<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterrequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersControllers extends Controller
{
    //
    /**
     * will register new user
     * @param UserRegisterRequest $request
     * @return void
     */
    public function register(UserRegisterRequest $request) {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $data['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('d-m-Y');

        $user = User::create($data);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ]);
    }
    /**
     * Will login user
     * @param Request request
     * @return json
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
    }
    $user = auth()->guard('api')->user();
    return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
}


    /**
     * return single user
     * @param $id
     * @return json
     */
    public function single_user($id) {
        $record = User::whereId($id)->first();
        if($record) {
            return response()->json(['success'=>true,'record'=>$record]);
        }
        return response()->json(['success'=>false]);
    }

      /**
     * return all users
     *
     * @return json
     */
    public function users() {
        $record = User::get();
            return response()->json(['success'=>true,'record'=>$record]);
    }
    /**
     * delete single user
     * @param $id
     * @return void
     */
    public function delete($id) {
        $record = User::whereId($id)->first();
        if($record) {
            $record->delete();
            return response()->json(['success'=>true,'msg'=>'user Deleted Succesfully']);
        }
    }

    /**
     * update single user
     * @param $id
     * @return void
     */
    public function update($id,UserRegisterRequest $request) {
        $record = User::whereId($id)->first();
        if($record) {
            $data = $request->validated();
            $data['password'] = bcrypt($request->password);

            $data['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('d-m-Y');

            $record->update(
               $data
            );
            return response()->json(['success'=>true,'msg'=>'user Updated Succesfully']);
        }
    }

}
