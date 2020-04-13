<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Libraries\JwtLibrary;
use App\Libraries\UploadImages;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends MainController
{

    public function handelLogin()
    {
        $validation = ApiValidator::validateWithNoToken(User::loginRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $credentials = request()->only('email', 'password');
        $user = User::with('address')->where('email', $credentials['email'])
            ->orWhere('username', $credentials['email'])->first();
        if ($user) {
            //check if user and password matched
            if (Hash::check($credentials['password'], $user->password)) {
                //check if user not banned from admin
                if ($user->status == 'active') {
                    //get token
                    $token = JwtLibrary::encode($user->id, 'customer');
                    $user['token']=$token;
                    return ApiResponse::data(['auth_data' => $user]);
                } else if ($user->status == 'new') {
                    return ApiResponse::errors(['new_account' => ['account not active yet!']]);
                } else {
                    return ApiResponse::bannedMessage();
                }
            } else {
                return ApiResponse::errors(['account' => ["email or password wrong"]]);

            }
        } else {
            return ApiResponse::errors(['account' => ["email or password wrong "]]);
        }
    }

    public function handelRegistration()
    {
        $validation = ApiValidator::validateWithNoToken(User::registerRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $inputs = request()->only('name', 'email', 'username', 'password','phone1','phone2');
        $inputs['password'] = bcrypt($inputs['password']);
        User::create($inputs);
        return ApiResponse::success('done successfully');
    }

    public function handelForgetPassword()
    {
        $validation = ApiValidator::validateWithNoToken(User::forgetPasswordRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $user = User::where('email', request()->only('email'))->first();
        if ($user) {
            //generate random code to send to email
            $restPassword = $this->generateRandomString();
            //Mail::to(request()->only('email'))->send(new ResetPassword($restPassword));
            $user->update(['reset_password_code' => $restPassword]);
            return ApiResponse::success("code send to your mail");
        } else {
            return ApiResponse::errors(['email' => ["email wrong "]]);
        }
    }

    public function handelUpdateForgetPassword()
    {
        $validation = ApiValidator::validateWithNoToken(User::resetPasswordRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $user = User::where('email', request()->only('email'))->first();
        if ($user) {
            //check reset password code
            if ($user->reset_password_code == request()->reset_password_code) {
                $password = bcrypt(request()->password);
                $user->update(
                    [
                        'reset_password_code' => null,
                        'password' => $password
                    ]);
                return ApiResponse::success("password change  successfully ");
            } else {
                return ApiResponse::errors(['reset_password' => ["code wrong"]]);
            }
        } else {
            return ApiResponse::errors(['email' => ["email wrong"]]);
        }
    }

    public function changePassword()
    {

        $validation = ApiValidator::validate(User::changePassword());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $user = User::find($this->user->id);
        if (Hash::check(request()->old_password, $user->password)) {
            $password = bcrypt(request()->new_password);
            $user->update(
                [
                    'password' => $password
                ]);
            return ApiResponse::success("password change  successfully ");
        } else {
            return ApiResponse::errors(['password_error' => "password wrong"]);
        }
    }


    public function changePhoto()
    {
        $validation = ApiValidator::validate(User::changePhoto());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $user = User::find($this->user->id);
        //delete current image if found
        if(!empty($user->image))
        {
            @unlink($user->image);
        }
        $imageName = UploadImages::upload('profile', request()->file('image'));
        $imageUrl = UploadImages::fullUrl($imageName, 'profile');
        $user->update(
            [
                'image' =>$imageUrl
            ]);
        return ApiResponse::data(['image' =>$imageUrl]);
    }


    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function code()
    {
        $user=User::where("email",request()->email)->select('reset_password_code as code')->first();
        return $user;
    }

    public function getProfile()
    {
        $validation = ApiValidator::validate(User::token());
        if ($validation) {
            return ApiResponse::errors($validation);
        }

        $user=User::with('address')->find($this->user->id);
        return ApiResponse::data(['user_profile'=>$user]);
    }

    public function editProfile()
    {
        $validationUser = ApiValidator::validate(User::profileRules($this->user->id));
        if ($validationUser) {
            return ApiResponse::errors($validationUser);
        }
        $inputs=request()->all();

        User::find($this->user->id)
            ->update($inputs);
        return ApiResponse::success('successfully Updated');
    }
}
