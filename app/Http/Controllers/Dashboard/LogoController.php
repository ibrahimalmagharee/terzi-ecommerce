<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LogoRequest;
use App\Models\Logo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class LogoController extends Controller
{
    public function index(Request $request)
    {
        $logos = Logo::all();
        if ($request->ajax()) {

            return DataTables::of($logos)
                ->addIndexColumn()

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->photo) . '" border="0"  alt="j" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.logo', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل"  class="primary box-shadow-3 mb-1 editLogo" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteLogo" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);

        }
        return view('admin.logo.index');
    }

    public function store(LogoRequest $request)
    {
        DB::beginTransaction();

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('logo_site', $request->photo);

        }

        $logo = Logo::create([
            'photo' => $filePath
        ]);

        $logo->save();

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة الشعار بنجاح'
        ]);
    }

    public function edit($id)
    {
        $logo = Logo::find($id);

        $notification = array(
            'message' => 'هذا الشعار غير موجود',
            'alert-type' => 'error'
        );

        if (!$logo)
            return redirect()->route('index.logo')->with($notification);


        return view('admin.logo.edit', compact('logo'));
    }

    public function update($id, LogoRequest $request)
    {
        $logo = Logo::find($id);

        $notification = array(
            'message' => 'هذا الشعار غير موجود',
            'alert-type' => 'error'
        );

        if (!$logo)
            return redirect()->route('index.logo')->with($notification);

        DB::beginTransaction();


        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/logo_site/') . $logo->photo;
            unlink($image_path);
            $filePath = uploadImage('logo_site', $request->photo);
            $logo->where('id', $id)->update([
                'photo' => $filePath
            ]);
        }

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث الشعار بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.logo')->with($notification);
    }

    public function destroy($id)
    {

        $logo = Logo::find($id);
        if (!$logo) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الشعار غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/logo_site/') . $logo->photo;
            unlink($image_path);
            $logo->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الشعار بنجاح',
            ]);
        }


    }
}
