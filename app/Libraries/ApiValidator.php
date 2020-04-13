<?php
namespace App\Libraries;
use Illuminate\Support\Facades\Validator;

class ApiValidator{
	public static function validateWithNoToken($rules){
		 $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return $validate->messages();
        }
	}


	public static function validateWithDeviceToken($rules){
        if(empty(request()->header('deviceToken')))
        {
            return ApiResponse::emptyToken();
        }
	    $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return $validate->messages();
        }
	}



    public static function validate($rules){
        if(empty(request()->header('token')))
        {

            return ApiResponse::emptyTokenHeader()->original;

        }
        else
        {
            $token=JwtLibrary::decode(request()->header('token'));
            if ($token==false)
                return ApiResponse::emptyTokenHeader();
        }

        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return $validate->messages();
        }
    }

    public  static function ConvertStringImageToArray($ImagesString){
        $ImageArray=explode(',',$ImagesString);
        return $ImageArray;
    }

}
