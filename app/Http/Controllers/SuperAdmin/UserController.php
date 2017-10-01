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

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'phone' => 'required|max:255',
            'password' => 'required|min:6',
            'bio' => 'required',
            'role' => 'required',
            'balance' => 'required|min:0'
        ];

        $input = $request->only(
            'name',
            'username',
            "phone",
            'password',
            'bio',
            'role',
            'balance'
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return JsonReturn::error($validator->messages());
        }

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $request->phone,
                'bio' => $request->bio,
                'balance' => $request->balance,
                'password' => bcrypt($request->password)]
        );

        if (in_array($request->role, User::roles())) {
            $user->role = $request->role;
            $user->save();
        }

        return JsonReturn::success($user);
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

            $user->banned = filter_var($request->banned, FILTER_VALIDATE_BOOLEAN);
            $user->save();

            return JsonReturn::successData($user);
        }

    }
}
