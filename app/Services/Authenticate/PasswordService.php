<?php
declare(strict_types=1);

namespace App\Services\Authenticate;

use App\Services\Mail\MailService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Repositories\Authenticate\PasswordRepository;


class PasswordService
{

    private $passwordRepository;
    private $mailService;
   

    public function __construct(PasswordRepository $passwordRepository, MailService $mailService){
        $this->passwordRepository = $passwordRepository;
        $this->mailService = $mailService;
      
    }

    public function password_reset($request){

        if(!$userActive = $this->passwordRepository->EmailActive(e($request->email))){
            return response()->json(['error' => 'El correo no esta activo o no existe'], 403);
        }

            $user = $userActive = $this->passwordRepository->get($userActive->id);
            $token = JWTAuth::fromUser($userActive);
            
           
            $user->token_validate     = (string)$token;
            $user->restoring_password = 1;
    
            $user = $this->passwordRepository->save($userActive);
          
            $credentials = collect([
                'email'                 => 'aliagasport@gmail.com',
                'password'              => 'abracadabra#963'
            ]);
        
            $subject = 'Restablecer contrasena';

            $view = View::make('email.restorePassword',[ 'token' => (string)$user->token_validate]);

            
      
            if(!$this->mailService->sendEmailFromGmail($credentials,$request->email,$subject,$view)){
                return response()->json(['error' => 'No fue posible el envio del email para restablecer la contraseña'], 500); 
            }

            
            
            return response()->json(['success' => true], 200);
    }

    public function validateTokenToShowPasswordReset($request){
        // vengo redireccionado con el token en la url y recibo por get desde el front
        if(!$this->passwordRepository->SearchTokenValidate($request->token_validate)){
            return response()->json(['error' => 'El token es invalido'], 401);
        }
                    // muestro el formulario para restablecer contraseña y
                    // este token lo tomo en el front y lo pongo en la url
                    // para tenerlo siempre en la url al momento de recargar la pagina restableciendo a contraseña
                    //al enviar las contraseñas, envio : las dos contraseñas y el token para validar
                    // si el token q me envian por get es valido y su estado restoring es 1, muestro form para restaurar contraseña
        return response()->json(['success' => true], 200);
    }


    public function restore_password($request){
       
        if(!$userPasswordReset = $this->passwordRepository->SearchTokenValidate($request->token_validate)){
            return response()->json(['error' => 'El token es invalido'], 401);
        }

        $userPasswordReset->restoring_password      =  0;
        $userPasswordReset->password                = Hash::make($request->input('password'));
        $this->passwordRepository->save($userPasswordReset);
        return response()->json(['success' => true,], 200);

    }
   
}

