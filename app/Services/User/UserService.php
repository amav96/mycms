<?php 

namespace App\Services\User;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;

class UserService {

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function updateUser($request){

        $user               = User::find(e($request->id));
        if(!$user){
            return response()->json(['error' => 'Usuario a actualizar no encontrado'],404);
        }

        $user->role         = e($request->role);
        $user->status       = e($request->status);
        $this->userRepository->save($user);
        return response()->json(['success' => 'Usuario actualizado correctamente'],200);
        
    }

    public function updatePhone($request){
        $user               = User::find(Auth::id());
        $user->phone        = $request->input('phone');
        $this->userRepository->save($user);
        return response()->json(['success' => 'Telefono actualizado correctamente'],200);

    }

    public function updateName($request){
        $user                = User::find(Auth::id());
        $user->firstName     = $request->input('firstName');
        $user->lastName      = $request->input('lastName');
        $this->userRepository->save($user);
        return response()->json(['success' => 'Nombre actualizado correctamente'],200);

    }

    public function updateGender($request){
        $user                = User::find(Auth::id());
        $user->gender        = $request->input('gender');
        $this->userRepository->save($user);
        return response()->json(['success' => 'Genero actualizado correctamente'],200);
    }

    public function updateBirthday($request){

        $user                = User::find(Auth::id());
        $user->birthday      = $request->input('birthday');
        $this->userRepository->save($user);
        return response()->json(['success' => 'Fecha actualizado correctamente'],200);
    }

    public function updatePassword($request){

        if(!$user = $this->userRepository->correctPassword($request->currentPassword)){
            return response()->json(['error' => 'Contraseña incorrecta'],403);
        }

        $user->password      = Hash::make($request->input('newPassword'));
        $this->userRepository->save($user);
        return response()->json(['success' => 'Contraseña actualizado correctamente'],200);

    }

}