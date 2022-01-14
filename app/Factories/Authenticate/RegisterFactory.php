<?php 
namespace App\Factories\Authenticate;
use App\Http\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class RegisterFactory {

    private $model;

    public function __construct(){
        $this->model = new User;
    }

    public function createRegister($request){

        $user                    = $this->model;
        $user->firstName         = e($request->firstName); 
        $user->lastName          = e($request->lastName); 
        $user->identification    = e($request->identification); 
        $user->email             = e($request->email); 
        $ramdon                  = mt_rand(); 
        $user->token_validate    = (string)JWTAuth::fromUser($user);
        $user->code              = substr(strval($ramdon),0,4);
        $user->password          = Hash::make(e($request->password));
        return $user;
    }

}