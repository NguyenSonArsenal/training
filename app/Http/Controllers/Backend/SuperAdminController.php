<?php
namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Backend\AdminCreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AdminRepository;

class SuperAdminController extends BaseController
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
        $destinationPath = doUpload();
        if ($destinationPath) {
            deleteFileTmp(public_path(session()->get('image.pathImgTmp')));
        }

        $listRequest['ins_id'] = currentAdmin()->id;
        $listRequest['avatar'] = $destinationPath;
        if (isset($listRequest['image'])) {
            unset($listRequest['image']);
        }

        if ($this->_repository->create($listRequest)) {
            session()->forget('image');
            return redirect()->route('superadmin.home')
                ->with(getConfig('create.title'), getConfig('create.message'));
        };

        return false;
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

    public function js()
    {
        $listAdmins = $this->_repository->getListAdmins();

        $viewDatas = [
            'admins' => $listAdmins
        ];

        return view('backend.superadmin.admin.js')->with($viewDatas);
    }
}