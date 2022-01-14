<?php
namespace App\Repositories\Authenticate;
use App\Http\Models\User;
use App\Repositories\BaseRepository;

class RegisterRepository extends BaseRepository  {

    
    public function __construct(User $user){
        parent::__construct($user);
    }

    public function existEmail($email){
        return User::select('email')->where('email', $email)->get()->first();
    }

    public function existIdentification($identification){
        return User::where('identification', $identification)->get()->first();
    }

    public function waitingToValidate($email){
        return User::where('email', $email)->Where('status', 'esperando_validar')->get()->first();
    }

    public function validateCodeAndToken($token,$code){
        return User::where('token_validate', $token)->Where('code', $code)->get()->first();
    }

    public function checkTokenWithStatusWaitingToValidate($token){
        return User::where('token_validate', $token)->Where('status', 'esperando_validar')->get()->first();
    }

    


}