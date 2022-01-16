<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UsersDashboardRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class UsersDashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = Admin::where('role_id', '!=', 1)->get();

        $roles = Role::get();

        if ($request->ajax()) {

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('role_id', function ($row) {
                    return $row->role->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.user', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editUser" class="primary box-shadow-3 mb-1 editUser" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteUser" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.usersDashboard.index', compact('users', 'roles'));
    }

    public function store(UsersDashboardRequest $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المستخدم بنجاح'
        ]);


    }

    public function edit($id)
    {
        $user = Admin::find($id);

        $notification = array(
            'message' => 'هذا المستخدم غير موجود',
            'alert-type' => 'error'
        );
        if (!$user)
            return redirect()->route('index.users')->with($notification);

        $roles = Role::get();
        return view('admin.usersDashboard.edit', compact('user', 'roles'));
    }

    public function update($id, UsersDashboardRequest $request)
    {
        $user = Admin::find($id);

        $notification = array(
            'message' => 'هذا المستخدم غير موجود',
            'alert-type' => 'error'
        );
        if (!$user)
            return redirect()->route('index.users')->with($notification);

        $user->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
        $notification = array(
            'message' => 'تم تحديث المستخدم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.users')->with($notification);
    }

    public function destroy($id)
    {

        $user = Admin::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية حذف المستخدم',
            ]);
        } else {
            $user->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف المستخدم',
            ]);
        }


    }
}
