<?php
namespace App\Http\Controllers\User;

use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\user\UpdateUser, App\Http\Requests\user\FilterUsers;
use App\Http\Requests\user\UpdateBirthday, App\Http\Requests\user\UpdateGender, App\Http\Requests\user\UpdateName, App\Http\Requests\user\UpdatePassword, App\Http\Requests\user\UpdatePhone;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepositories){
        $this->userRepositories = $userRepositories;
    }

    // GET DATA
    public function getUsers(Request $request){

        $dataRequest =  $request->dataRequest ?  json_decode($request->dataRequest,true) : false;
   
        $users = User::when($dataRequest && ( !isset($dataRequest["status"]) || $dataRequest["status"] === 'all' ), function($query,$dataRequest){
            return $query->orderBy('id','Desc');
        }, function($query){
            return $query->where('status',json_decode(request()->dataRequest,true)["status"])
                         ->orderBy('id','Desc');
        })->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);

        if($users && count($users)>0){
            return response()->json($users,200);
        }else{ return response()->json(['error' => 'No se encontraron resultados'],200);}

    }

    // GET FILTER

    public function filterUsers(FilterUsers $request){


        $dataRequest =  $request->dataRequest ?  json_decode($request->dataRequest,true) : false;
       
    
        $users = User::filterUsers($request,$dataRequest)->paginate(isset($dataRequest["limit"]) ? $dataRequest["limit"] : 10);

        if($users && count($users)>0){
            return response()->json($users,200);
        }else{ return response()->json(['error' => 'No se encontraron resultados'],404);}
                
    }

    //ACTIONS 

    public function updateUser(UpdateUser $request, UserService $userService){
        return $userService->updateUser($request);
    }

    public function updatePassword(UpdatePassword $request, UserService $userService){
        return $userService->updatePassword($request);
    }

    public function updatePhone(UpdatePhone $request, UserService $userService){
        return $userService->updatePhone($request);
    }

    public function updateName(UpdateName $request, UserService $userService){
        return $userService->updateName($request);
        
    }

    public function updateGender(UpdateGender $request , UserService $userService){
        return $userService->updateGender($request);
         
    }

    public function updateBirthday(UpdateBirthday $request , UserService $userService){
        return $userService->updateBirthday($request);

    }
    

}
