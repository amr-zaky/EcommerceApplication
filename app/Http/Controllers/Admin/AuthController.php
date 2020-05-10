<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminDashboard');
        }
        return view('AdminPanel.login');
    }

    public function handleLogin(Request $request)
    {

        $request->validate(Admin::loginRules());
        $email = $request->email;
        $password = $request->password;
        $data = ['email' => $email, 'password' => $password];
        if (Auth::guard('admin')->attempt($data)) {
            // Success redirect

            return redirect()->intended(route('adminDashboard'));
        } else {
            return redirect()->back()
                ->with('status', 'login_error')
                ->with('message', "Email Or Password Wrong");
        }
    }

    public function profile()
    {
        return view('AdminPanel.profile');
    }
    public function EditProfile(Request $request)
    {
        $request->validate(Admin::editRules(Auth::guard('admin')->user()->id));
        $inputs=$request->only('email');
        if ($request->input('password'))
        {
            $inputs['password'] =bcrypt($request->input('password'));
        }
        Admin::find(Auth::guard('admin')->user()->id)->update($inputs);
       return redirect()->back()->with('message','Edit Successfully');
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminLogin');
    }
}
