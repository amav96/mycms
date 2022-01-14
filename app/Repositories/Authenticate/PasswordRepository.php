<?php
namespace App\Repositories\Authenticate;
use App\Http\Models\User;
use App\Repositories\BaseRepository;

class PasswordRepository extends BaseRepository  {

    
    public function __construct(User $user){
        parent::__construct($user);
    }

    public function EmailActive($email){
        return User::where('email', $email)->Where('status','activo')->get()->first();
    }

    public function SearchTokenValidate($token){
        return User::where('token_validate', $token)->Where('restoring_password',1)->get()->first();
    }
    
}