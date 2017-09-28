<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Response;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username',"phone", 'password','bio','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //Roles at the moment "user","admin","superadmin"
    public function hasRole($role){

        if($this->role == "superadmin"){
            return true;
        }
        else if($role == $this->role){
            return true;
        }

        return false;
    }

    public static function roleErrorResponse(){

        $error["error"] = "You do not have permission to access this";
        return Response::json($error, 200);

    }

}
