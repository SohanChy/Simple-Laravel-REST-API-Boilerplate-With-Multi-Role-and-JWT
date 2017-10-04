<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\JsonReturn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewUserController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function createUser(Request $request)
     {
         $rules = [
             'name' => 'required|max:191',
             'username' => 'required|max:191|unique:users',
             'phone' => 'required|max:191',
             'password' => 'required|min:6',
             'bio' => 'required',
         ];
 
         $input = $request->only(
             'name',
             'username',
             "phone",
             'password',
             'bio'
         );
 
         $validator = Validator::make($input, $rules);
         if ($validator->fails()) {
             return JsonReturn::error($validator->messages());
         }
 
         $user = User::create([
                 'name' => $request->name,
                 'username' => $request->username,
                 'phone' => $request->phone,
                 'bio' => $request->bio,
                 'password' => bcrypt($request->password)]
         );
 
         return JsonReturn::success($user);
     } 
}
