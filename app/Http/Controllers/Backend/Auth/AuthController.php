<?php
namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminLoginRequest;
use Auth;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('backend.login');
    }

    public function postLoginAdmin(AdminLoginRequest $request)
    {
        $listRequest = $request->all();

        $requestLoginAdmin = [
            'email'     => array_get($listRequest, 'email'),
            'password'  => array_get($listRequest, 'password'),
        ];

        if (Auth::guard('admins')->attempt($requestLoginAdmin))
        {
            $admin = Auth::guard('admins')->user();

            if ($admin->role_type == config('settings.role_type.superadmin.id', 1))
            {
                return redirect()->route('superadmin.home');
            }
            else if ($admin->role_type == config('settings.role_type.admin.id', 2))
            {
                return redirect()->route('admin.home');
            }
        }
        else
        {
            return redirect()->route('admin.login.get')
                             ->withInput()
                             ->withErrors(['admin_login_error' => 'Tài khoản không tồn tại']);
        }
    }

    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login.get');
    }
}