<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Storage;
use Auth;
use Helper;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasFactory;

    protected $primaryKey = 'user_id';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id','role_id','firstname','lastname','username','email', 'password','phone','photo','isactive'
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
    /*
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    /**
     * Get the user's full name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute() 
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Get the user's photo.
     *
     * @param  string  $value
     * @return string
     */
    public static function getPhotoAttribute($value) 
    {
        return Helper::getProfileImg($value);
    }

    public static function getLogoAttribute($value) 
    {
        return Helper::getProfileImg($value);
    }

    /**
     * Delete File from storage
     *     
     */
    public function deleteFile($file="") 
    {
        return Storage::delete($file);
    }

    public function getRoleId($user_id=0){
        if($user_id>0){
            $user = $this->find($user_id);
        }
        else if(Auth::check()){
            $user = Auth::user();
        }
        if(isset($user)){
            $role_id = $user->role_id;
            return $role_id;
        }
        return null;
    }
}
