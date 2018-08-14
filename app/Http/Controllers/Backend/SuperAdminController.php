<?php
namespace App\Http\Controllers\Backend;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\Backend\AdminCreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AdminRepository;
use Mail;

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
        $srcImage = session()->has('hasTmpImage') ? session()->get('tmpImage.pathImgTmp')
                                                       : 'assets/admin/images/default.png';
        return view('backend.superadmin.admin.create', compact('srcImage'));
    }

    public function store(AdminCreateRequest $request)
    {
        $listRequest = $request->all();
        $destinationPath = doUpload();
        if ($destinationPath) {
            deleteAllFileInForder(public_path(getConfig('tmp_upload_dir', 'tmp_uploads')));
        }

        $listRequest['ins_id'] = currentAdmin()->id;
        $listRequest['avatar'] = $destinationPath;
        if (isset($listRequest['image'])) {
            unset($listRequest['image']);
        }

        if ($this->_repository->create($listRequest)) {
            session()->forget('tmpImage');
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

    public function sendMail()
    {
        $emailTos = ['vanson297.nguyen@gmail.com'];

        $emaliCCs = ['luongthequanabc@gmail.com', 'vanhienhoang603@gmail.com', 'yeuemtenthai@gmail.com'];

        $viewDatas = ['name' => 'NguyenSonArsenal', 'title' => 'I miss you so much'];

        Mail::send('backend.superadmin.admin.mailfb', $viewDatas,
            function ($message) use ($emailTos, $emaliCCs){
                $message->from('sonnv.paraline@gmail.com', 'Admin_paraline');
                $message->to($emailTos)->cc($emaliCCs)
                    ->subject('This is title of mail');
            }
        );
        session()->flash('send_mail_success_flag', true);
        return redirect()->route('superadmin.home')->with('send_mail_success', "Mail send successfully");
    }
}