<?php
namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('backend.login');
    }

    // demo sql injection
    public function postLoginAdmin(Request $request)
    {
        // Connect to mysql
        $conn = mysqli_connect('127.0.0.1','root','','training');

        // Check connection
        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $request->name;
        $password = $request->password;

        $sql = "SELECT * FROM admins where name = '$name' and password = '$password'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        if (mysqli_num_rows($result)) {
            session()->put('name', $name);
            return redirect()->route('superadmin.home');
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