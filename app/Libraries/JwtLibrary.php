<?php
namespace App\Libraries;
use \Firebase\JWT\JWT;

class JwtLibrary{

    static $key = "j*ZF=GR5A_fLWkd=#f8v6+q32g8wq3e8";
    public static function encode($user_id, $type){
        $uxt = strtotime(date('Y-m-d H:i:s'));
        $token = array(
            "iat" => $uxt,
            "id" => $user_id,
            "nbf" => $uxt,
            "type" => $type,
            "jti" => md5($user_id.$uxt)
        );
        $jwt = JWT::encode($token, self::$key);
        return $jwt;
    }

    public static function decode($jwt){
        try{
            $decoded = JWT::decode($jwt, self::$key, array('HS256'));
        }
       catch (\Exception $decoded)
       {
           return false;
       }

        return $decoded;
    }


    public static function getToken(){
        if(!empty(request()->header('token'))){
            $token = request()->header('token');
        }elseif(!empty(request()->input('token'))){
            $token = request()->input('token');
        }else{
            $token = "";
        }
        return $token;
    }
}
