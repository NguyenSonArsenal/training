<?php
namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AdminRepository;

class SuperAdminController extends Controller
{
    protected $_repository = '';

    public function __construct(AdminRepository $adminRepository)
    {
        parent::__construct();
        $this->_repository = $adminRepository;
    }

    public function index(Request $request)
    {
        $listAdmins = $this->_repository->getListAdmins();

        $viewDatas = [
            'admins' => $listAdmins
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