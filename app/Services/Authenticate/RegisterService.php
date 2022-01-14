<?php
declare(strict_types=1);

namespace App\Services\Authenticate;

use App\Services\Mail\MailService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Factories\Authenticate\RegisterFactory;
use App\Repositories\Authenticate\RegisterRepository;


class RegisterService
{

    private $registerRepository;
    private $mailService;
    private $registerFactory;

    public function __construct(RegisterRepository $registerRepository, MailService $mailService, RegisterFactory $registerFactory){
        $this->registerRepository = $registerRepository;
        $this->mailService = $mailService;
        $this->registerFactory = $registerFactory;
    }
   
    
    public function handlerRegister($request){

        if($this->registerRepository->existEmail(e($request->email))):
            return $this->existingRegister($request);
        else:
            return $this->newRegister($request );
        endif;
       
    }

    public function existingRegister($request){

        if(!$waitingToValidate = $this->registerRepository->waitingToValidate(e($request->email))){
            return response()->json(['email' => ['El email pertenece a una cuenta registrada']], 403);
        }else {

            if($waitingToValidate->identification !== $request->identification){
                return response()->json([
                    'email' => ['Esta cuenta ya ha sido registrada con otro nùmero de documento']
                ], 403); 
            }

            $user                       = $this->registerRepository->get($waitingToValidate->id);
            $user->firstName            = e($request->input("firstName"));
            $user->lastName             = e($request->input("lastName"));
            $user->identification       = e($request->input("identification"));
            $user->password             = Hash::make($request->input("password")); 
            $ramdon                     = mt_rand(); 
            $user->code                 = substr(strval($ramdon),0,4);
            $user->token_validate       = JWTAuth::fromUser($user);

          
            $this->registerRepository->save($user);
            $credentials = collect([
                'email'                 => 'aliagasport@gmail.com',
                'password'              => 'abracadabra#963'
            ]);

            $subject = 'Tu codigo es '.$user->code;

            $view = View::make('email.confirmation',[ 
                'code'                  => $user->code,
                'email'                 => $request->email,
                'lastName'              => $user->lastName,
                'token'                 => $user->token_validate
                ]);

            if(!$this->mailService->sendEmailFromGmail($credentials,$request->email,$subject,$view)){
                return response()->json(['error' => 'No se envio el email correctamente'], 500); 
            }
            
            return response()->json(['success' => true,'token'=> $user->token_validate] ,200);
        }
    }

    public function newRegister($request){

        if($this->registerRepository->existIdentification(e($request->identification))){
            return response()->json(['identification' => ['El documento petenece a una cuenta registrada']], 403); 
        }else{
            $user = $this->registerFactory->createRegister($request);

            $this->registerRepository->save($user);
            $credentials = collect([
                'email'                 => 'aliagasport@gmail.com',
                'password'              => 'abracadabra#963'
            ]);

            $subject = 'Tu codigo es '.$user->code;

            $view = View::make('email.confirmation',[ 
                'code'                  => $user->code,
                'email'                 => $request->email,
                'lastName'              => $user->lastName,
                'token'                 => $user->token_validate
                ]);

            if(!$this->mailService->sendEmailFromGmail($credentials,$request->email,$subject,$view)){
                $email = env('EMAIL_USERNAME');
                
                $pass = env('EMAIL_PASSWORD');
            
                return response()->json(['error' => 'Ha sido registrado, pero no fue posible el envio del email para comprobar el mismo. Intente registrarse nuevamente'.$email. ' '. $pass], 500); 
            }
            
            return response()->json(['success' => true,'token'=> $user->token_validate , 'mail' => $request->email] ,200);

        }
            
    }

    public function validateCode($request){

        $token_validate                  = $request->token_validate;
        $code                            = $request->code;
        $validatedUser                   = $this->registerRepository->validateCodeAndToken($token_validate,$code);

        if(!$validatedUser) return response()->json(['error' => 'Codigo inválido'],404);

        $validatedUser->status = 'activo';
        date_default_timezone_set('America/Argentina/Buenos_Aires'); $date = date('Y-m-d H:i:s');
        $validatedUser->email_verified_at  = $date;
        $this->registerRepository->save($validatedUser);

        return response()->json(['success' => true],200);
        
    }

    public function checkTokenRegister($request){
        $checkToken = $this->registerRepository->checkTokenWithStatusWaitingToValidate($request->token_validate);
        
        if(!$checkToken)    return response()->json(['error' => 'Token incorrecto',] ,401);
      
            return response()->json(
                [
                    'success'       => true,
                    'token'         => $checkToken->token_validate,
                    'email'         => $checkToken->email,
                ] ,200);
    }
   
}

