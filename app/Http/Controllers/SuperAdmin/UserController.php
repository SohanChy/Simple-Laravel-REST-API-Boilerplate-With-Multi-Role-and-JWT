<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\JsonReturn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUserList(Request $request)
    {
        return User::index($request);
    }

    public function setUserRole(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'new_role' => 'required'
        ]);

        if ($validator->fails()) {
            return JsonReturn::error($validator->errors());
        } else {
            $user = User::find($request->user_id);
            if(! $user){
                return JsonReturn::error("User not found");
            }

            if (in_array($request->new_role, User::roles())) {
                $user->role = $request->new_role;
                $user->save();
                return JsonReturn::success($user);
            }
            return JsonReturn::error();
        }

    }

    public function getRoleList()
    {
        return JsonReturn::successData(User::roles());
    }

    public function setUserBan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'banned' => 'required'
        ]);

        if ($validator->fails()) {
            return JsonReturn::error($validator->errors());
        } else {
            $user = User::find($request->user_id);
            if(! $user){
                return JsonReturn::error("User not found");
            }

            $user->banned = filter_var($request->banned, FILTER_VALIDATE_BOOLEAN);
            $user->save();

            return JsonReturn::successData($user);
        }

    }
}
