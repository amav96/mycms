<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\Http\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;



class AuthenticateController extends Controller
{

    public function __construct(){
        $this->middleware(['auth:api'])->except('login');
    }

    public function login(Request $request){

        try {
            $email = e($request->input('email'));
            if(!User::EmailActive($email)->get()->first()){
                $baneado = User::where('email',$email)->where('status','baneado')->get()->first();
                if($baneado){
                    return response()->json(['error' => 'baneado'], 200);
                }
                return response()->json(['error' => 'email_not_active'], 200);
            }
            $credentials = $request->only('email','password');

            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'invalid_credentials'], 200);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
       
            $currentUser = Auth::user();
           
        
            $user = array(
                'id'                => $currentUser->id,
                'role'              => $currentUser->role,
                'status'            => $currentUser->status,
                'email'             => $currentUser->email,
                'firstName'         => $currentUser->firstName,
                'lastName'          => $currentUser->lastName,
                'identification'    => $currentUser->identification,
                'phone'             => $currentUser->phone,
                'birthday'          => $currentUser->birthday,
                'gender'            => $currentUser->gender,
                
            );
            

            return response()->json(['success' => true, 'token' => $token, 'user' => $user],200);
    }

    public function checkToken(Request $request){

        if($currentUser = Auth::user()){
            return response()->json([
                'success' => true,
                'user' => [
                    'id'                => $currentUser->id,
                    'role'              => $currentUser->role,
                    'status'            => $currentUser->status,
                    'email'             => $currentUser->email,
                    'firstName'         => $currentUser->firstName,
                    'lastName'          => $currentUser->lastName,
                    'identification'    => $currentUser->identification,
                    'phone'             => $currentUser->phone,
                    'birthday'          => $currentUser->birthday,
                    'gender'            => $currentUser->gender,
                ],
                'token' => $request->token
                
            ],200);
        }else {
            return response()->json(['success' => false],200);
        }
        
    }

    public function logout(){
        
        $logout = auth()->logout();
        return response()->json(['success' => true]);
    }

    
}