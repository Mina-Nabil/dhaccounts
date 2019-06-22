<?php

namespace Laravel;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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


    function checkCredentials($userName, $passWord){
        return DB::table('users')->where('USER_UNAME', $userName)->where('USER_PSWD', $passWord)->count();
    }

    public static function getAllUsers(){
        return DB::table('users')
                    ->join('user_types', 'users.typeID', '=', 'user_types.id')->select('users.*', 'user_types.name')->get();
    }

    public static function getUserID($userName){
        return DB::table('users')
                    ->where('username',$userName)->get()->first()->id;
    }

    public static function getUserByID($id){
        return DB::table('users')
                    ->join('user_types', 'users.typeID', '=', 'user_types.id')->where('users.id',$id)->first();
    }

    public static function getTypes(){
        return DB::table('user_types')->get();
    }

    public static function insertUser($userName, $fullName, $typeID, $mobNumber, $password, $image=null){
        return DB::table('users')->insertGetId([
            'username' => $userName,
            'fullname' => $fullName,
            'typeID'   => $typeID,
            'mobNumber'=> $mobNumber,
            'password' => Hash::make($password),
            'image'    => $image,
        ]);
    }

    public static function updateUser($id, $userName, $fullName, $typeID, $mobNumber, $password=null, $image=null){

      $updateArray = [
          'username' => $userName,
          'fullname' => $fullName,
          'typeID'   => $typeID,
          'mobNumber'=> $mobNumber,
      ];
      if(!is_null($password)) $updateArray['password'] = Hash::make($password);
      if(!is_null($image)) $updateArray['image']  = $image;

      return DB::table('users')->where('id', $id)
      ->update($updateArray);
    }

}
