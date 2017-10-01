<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\JsonReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $input = $request->only('username', 'password');

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return JsonReturn::error($error);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return JsonReturn::error('Invalid Credentials. Please make sure you entered the right information.');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return JsonReturn::error('could_not_create_token', 500);
        }

        //if not banned
        $user = Auth::user();
        if ($user->banned) {
            return JsonReturn::error('Sorry, you are banned.');
        }

        // all good so return the token
        $data["user"] = $user->toArray();
        $data["token"] = $token;
        return JsonReturn::success($data);
    }

    public function me(Request $request)
    {
        return JsonReturn::success(Auth::user());
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request) {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return JsonReturn::success();
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return JsonReturn::error('Failed to logout, please try again.', 500);
        }
    }


}
