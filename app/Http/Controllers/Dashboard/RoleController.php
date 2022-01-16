<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::get();

        $permissions = Permission::get();

        if ($request->ajax()) {

            return DataTables::of($roles)
                ->addIndexColumn()

//                ->addColumn('permissions',  function ($row){
//                    return \GuzzleHttp\json_decode($row->permissions->map(function ($permission){
//                        return $permission->name;
//                    }));
//                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.role', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editRole" class="primary box-shadow-3 mb-1 editRole" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteRole" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.roles.index', compact('roles','permissions'));
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        $role = Role::create([
           'name' => $request->name,
        ]);

        $role->permissions()->attach($request->permissions);

        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة الصلاحية بنجاح'
        ]);

    }

    public function edit($id)
    {
        $role = Role::find($id);

        $data['permissions'] = Permission::get();

        $notification = array(
            'message' => 'هذه الصلاحية غير موجودو',
            'alert-type' => 'error'
        );
        if (!$role)
            return redirect()->route('index.roles')->with($notification);

        $role_permissions = collect();
        foreach ($role->permissions as $permissions){
            $role_permissions []= $permissions;

        }

        return view('admin.roles.edit', compact('role','data','role_permissions'));
    }

    public function update($id, RoleRequest $request)
    {
        DB::beginTransaction();

        $role = Role::find($id);

        if (!$role) {
            $notification = array(
                'message' => 'هذه الصلاحية غير موجودو',
                'alert-type' => 'error'
            );

            return redirect()->route('index.roles')->with($notification);

        }

        $role->where('id', $id)->update([
           'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        DB::commit();


        $notification = array(
            'message' => 'تم تحديث الصلاحية بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.roles')->with($notification);

    }

    protected function process(Role $role, Request $request)
    {
        $role->name = $request->name;
        $role->permissions = json_encode($request->permissions);
        $role->save();
        return $role;
    }

    public function destroy($id)
    {

        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية حذف الصلاحية',
            ]);
        } else {
            $role->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الصلاحية',
            ]);
        }


    }
}
