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

        if (backendGuard()->attempt($requestLoginAdmin)) {
            $admin = backendGuard()->user();
            if ($admin->isSuperAdmin()) {
                return redirect()->route('superadmin.home');
            }
            if ($admin->isAdmin()) {
                return redirect()->route('admin.home');
            }
        }
        return redirect()->route('admin.login.get')
            ->withInput()->withErrors(['admin_login_error' => 'Tài khoản không tồn tại']);
    }

    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login.get');
    }
}