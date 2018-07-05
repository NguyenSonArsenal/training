<?php
namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
//        $this->middleware('AdminMiddleware');
    }

    public function index()
    {
        $admin = Auth::guard('admins')->user();

        $adminUpdated = Admin::find($admin->admin_update_id);

        $viewDatas = [
            'admin'         => $admin,
            'adminUpdated'  => $adminUpdated
        ];

        return view('backend.admin.detail')->with($viewDatas);
    }

    public function editInfoAdmin($id)
    {
        $admin = Admin::findOrFail($id);

        $viewDatas = [
            'admin' => $admin,
            'nameRouteUpdateAdmin' => 'admin.update.admin'
        ];

        return view('backend.superadmin.admin.edit')->with($viewDatas);
    }

    public function update(AdminCreateRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $updatedAtBefore = $admin->updated_at;

        $listRequest = $request->all();

        $admin->name    = array_get($listRequest, 'name');
        $admin->email   = array_get($listRequest, 'email');
        $admin->admin_update_id = $id;

        $newPassword = array_get($listRequest, 'new_password');

        if ($newPassword)
            $admin->password = $newPassword;

        if ($request->hasFile('image'))
            $admin->avatar = upload('image');

        $admin->save();

        $updatedAtAfter = $admin->updated_at;

        if ($updatedAtBefore != $updatedAtAfter)
            return redirect()->back()->with('update_success', "Updated admin #$id successfully");
        else
            return redirect()->back()->with('update_success', "Nothing update admin #$id");

    }
}