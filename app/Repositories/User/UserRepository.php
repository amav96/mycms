<?php
namespace App\Repositories\User;
use App\Http\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository  {

    
    public function __construct(User $user){
        parent::__construct($user);
    }

    public function updatePassword(object $request){
            
            $this->model = User::find(Auth::id());
         if(!Hash::check($request->input('currentPassword'), $this->model->password)){
             return response()->json(['currentPassword' => ['La contraseña es invalida']],403);
         }else{
             $this->model->password = Hash::make($request->input('newPassword'));
             if(!$this->model->save()){
                 return response()->json(['error' => 'No se actualizo correctamente la contraseña'],500);
             }else{
                 return response()->json(['success' => 'Contraseña actualizada correctamente'],200);
             }
         }
    }

    public function correctPassword($password){

        $this->model = User::find(Auth::id());
        if(!Hash::check($password, $this->model->password)){
            return false;
        }
        return $this->model;
        
    }


}