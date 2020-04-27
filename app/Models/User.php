<?php

namespace App\Models;

use App\Libraries\JwtLibrary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Null_;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = ["id"];
    protected $hidden = ['password', 'remember_token', 'status', 'email_verified_at', 'reset_password', 'reset_password_code','createdBy','modifiedBy','created','modified'];
    public $timestamps = false;
                                /************************  validation Rules************************/
    public static function userData()
    {
        $jwt_token = JwtLibrary::getToken();
        if (isset($jwt_token) && !empty($jwt_token)) {
            $userObject = JwtLibrary::decode($jwt_token);
            return $userObject;
        }
    }

    public static function loginRules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
    }
    public static function registerRules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|min:4|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'phone1' => 'required|regex:/(01)[0-9]{9}/',
            'phone2' => 'regex:/(01)[0-9]{9}/',

        ];
    }
    public static function forgetPasswordRules()
    {
        return [
            'email' => 'required|email'
        ];
    }

    public static function checkResetPasswordRules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'reset_password_code' => 'required'
        ];
    }

    public static function resetPasswordRules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
        ];
    }

    public static function changePassword()
    {
        return [
            'new_password' => 'required|confirmed|min:6',
            'old_password' => 'required|min:6',
        ];
    }

    public static function changePhoto()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ];
    }

    public static function rate()
    {
        return [
            'rate' => 'required|in:1,2,3,4,5',
            'product_id' => 'required|exists:products,id'
        ];
    }

    public static function profileRules($id)
    {

        return [
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'default_currency_id' => 'required',
        ];
    }
    public static function token()
    {
        return[];
    }


                                     /************************relations************************/

    public  function address()
    {
        return $this->hasMany(UserAddress::class);
    }
}
