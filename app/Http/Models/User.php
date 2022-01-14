<?php

namespace App\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Carbon\Carbon;



class User extends Authenticatable implements JWTSubject
{
    

    use Notifiable;

    protected $table = 'users';

    /**
     * Set the published_at date format
     *
     * @param $date
     * @return string
     */
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // CARBON

     public function getCreatedAtAttribute($value)
     {
         return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i:s');
         
     }

     public function getUpdatedAtAttribute($value)
     {
        return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y H:i:s');
     }

     public function getBirthdayAttribute($value)
     {
        return Carbon::parse($this->attributes['birthday'])->format('d-m-Y');
     }

    // SCOPE

            // FILTER

            public function scopeFilterUsers($query,$request,$dataRequest){   
                 return $query->when(isset($dataRequest["status"]) && $dataRequest["status"] !== 'all', function($query){
                    return $query->where(function($query){
                                    $query->where('status',request('status'));
                                })
                                ->where(function($query){
                                    $query->Where('firstName','like','%'.request('filter').'%')
                                    ->orWhere('lastName','like','%'.request('filter').'%')
                                    ->orWhere('email','like','%'.request('filter').'%')
                                    ->orWhere('identification','like','%'.request('filter').'%');
                                });

                 })->when(!isset($dataRequest["status"]) || empty($dataRequest["status"]) || $dataRequest["status"] === 'all', function($query){
                    $query->Where('firstName','like','%'.request('filter').'%')
                            ->orWhere('lastName','like','%'.request('filter').'%')
                            ->orWhere('email','like','%'.request('filter').'%')
                            ->orWhere('identification','like','%'.request('filter').'%');
                 });
             }

            // HELPERS Autenticate

            public function scopeIsAdmin($query){
                return $query->where('role', 'admin');           
            }

            public function scopeEmailActive($query,$email){
                return $query->where('email',$email)
                            ->Where('status','activo');
            }

            public function scopeIsRestoringPassword($query,$token){
                return $query->where('restoring_password' , 1);
            }

}
