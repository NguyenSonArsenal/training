<?php
namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::orderBy('id', 'desc');

        $search = array_get($request->all(), 'search');
        $filter = intval(array_get($request->all(), 'filter'));

        if ($search)
        {
            $admins->where('id', intval($search))
                    ->orWhere('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
        }

        if ($filter) {
            if ($filter == config('settings.role_type.superadmin.id') || $filter == config('settings.role_type.admin.id')) {
                $admins->where('role_type', $filter);
            }
        }

        $admins = $admins->paginate(config('settings.limit.default'));

        $viewDatas = [
            'admins' => $admins
        ];

        return view('backend.superadmin.admin.index')->with($viewDatas);
    }

    public function create()
    {
        return view('backend.superadmin.admin.create');
    }

    public function store(AdminCreateRequest $request)
    {
        $listRequest = $request->all();

        $admin = Auth::guard('admins')->user();

        $listRequest['admin_ins_id'] = $admin->id;
        $listRequest['admin_ins_id'] = $admin->id;

        Admin::create($listRequest);

        return redirect()->route('superadmin.home')->with('create_success', 'A new admin is created successfully');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        if ($admin != null)
        {
            $viewDatas = [
                'admin' => $admin,
                'nameRouteUpdateAdmin' => 'superadmin.update.admin'
            ];

            return view('backend.superadmin.admin.edit')->with($viewDatas);
        }
        else
        {
            dd('Admin is not found');
        }
    }

    public function update(AdminCreateRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $listRequest = $request->all();

        $admin->name        = array_get($listRequest, 'name');
        $admin->email       = array_get($listRequest, 'email');
        $admin->role_type   = array_get($listRequest, 'role_type');

        if ($request->has('image')) {
            $admin->avatar = upload('image');
        }

        $admin->save();

        return redirect()->route('superadmin.home')->with('update_success', "Updated admin #$admin->id successfully ");
    }

    public function destroy($id)
    {
        Admin::where('id', $id)->delete();

        return back()->with('delete_success', "Deleted admin #$id successfully");
    }
}