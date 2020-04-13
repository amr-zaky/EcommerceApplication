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
    protected $hidden = ['password', 'remember_token','status', 'email_verified_at', 'reset_password', 'reset_password_code', 'created_at', 'updated_at'];

    public static function userData()
    {
        $jwt_token = JwtLibrary::getToken();
        if (isset($jwt_token) && !empty($jwt_token)) {
            $decode_token = JwtLibrary::decode($jwt_token);
            return $decode_token;
        }
    }

    public static function loginRules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
    }

    public static function token()
    {
        return [];
    }

    public static function registerRules()
    {
        return [
            'name' =>'required',
            'email' =>'required|unique:users,email',
            'username' =>'required|min:4|unique:users,username',
            'password' =>'required|confirmed|min:6',
            'phone'=>'required|numeric',
            'country_id'=>'required|exists:countries,id',
            'city_id'=>'required|exists:cities,id',
            'area_id'=>'required|exists:areas,id',
        ];
    }

    public static function forgetPasswordRules()
    {
        return [
            'email' => 'required|email'
        ];
    }

    public static function resetPasswordRules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
            'reset_password_code' => 'required'
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
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public static function deviceTokenRole()
    {
        return [
            'device_token' => 'required',
        ];
    }

    public function currency()
    {
        return $this->belongsTo(Currencies::class,'default_currency_id');
    }

    public static function rate()
    {
        return [
            'rate' => 'required|in:1,2,3,4,5',
            'product_id'=>'required|exists:products,id'
        ];
    }

    public static function profileRules($id)
    {

        return [
            'email' => 'required|email|unique:users,email,' . $id,
            'name'=>'required',
            'username'=>'required|unique:users,username,' . $id,
            'default_currency_id'=>'required',
        ];
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }




}
