<?php
namespace App\Libraries;

class ApiResponse{
	public static function errors($errorsArray){
		return response(['status' => false, 'errors' => $errorsArray],400);
	}

	public static function data($data){
		return response(['status' => true, 'data' => $data]);
	}

	public static function success($message)
    {
        return response(['status' => true, 'message' => $message]);
    }

    public static function bannedMessage()
    {
        return response(['status' => false, 'account_status' => 'banned', 'errors' => ['token' => [trans('main.account_is_banned')]]]);
    }
    public static function emptyToken()
    {
        return response(['status' => false, 'errors' => ['unauthorized'=>['you are unauthorized']]]);
    }

    public static function emptyTokenHeader()
    {
        return response(['unauthorized'=>['you are unauthorized']],400);
    }

}
