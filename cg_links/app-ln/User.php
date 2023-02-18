<?php

namespace App;

use App\Billing\StripeBilling;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public static $rules = array(
        'email'  => 'required|email|unique:users',
        'first_name' => 'required|min:2',
        'last_name'  => 'required|min:2'
    );
                                      
    public static $rules_password = array(
        'password'  => 'required|min:6|confirmed'
    );

    public function user_status() { return $this->belongsTo( 'App\UserStatus' ); }
    public function company() { return $this->belongsTo( 'App\Company' ); }

    public function ads() { return $this->hasMany(Ad::class, 'owner_id', 'id' ); }

    public function getFullNameAttribute() { return $this->first_name . " " . $this->last_name; }

}
