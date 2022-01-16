<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LogoVendorRequest;
use App\Models\Image;
use App\Models\LogoVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class LogoVendorController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();
        $logos = LogoVendor::all();
        if ($request->ajax()) {

            return DataTables::of($logos)
                ->addIndexColumn()
                ->addColumn('vendor_id', function ($row) {
                    return $row->vendor->name;
                })

                ->addColumn('photo', function ($row){
                    return '<img src="' . $row->getPhoto($row->image->photo) . '" border="0"  alt="j" style="width: 100px; height: 90px;" class="img-rounded" align="center" />';

                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.logo.vendor', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editLogoVendor" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteLogoVendor" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);

        }
        return view('admin.vendors.logo.index', compact('data'));
    }

    public function store(LogoVendorRequest $request)
    {
        DB::beginTransaction();
        $logo = LogoVendor::create([
            'vendor_id' => $request->vendor_id,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('logo', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $logo->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة الشعار بنجاح'
        ]);
    }

    public function edit($id)
    {
        $logo = LogoVendor::find($id);

        $notification = array(
            'message' => 'هذا الشعار غير موجود',
            'alert-type' => 'error'
        );

        if (!$logo)
            return redirect()->route('index.logo.vendors')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();

        return view('admin.vendors.logo.edit', compact('logo', 'data'));
    }

    public function update($id, LogoVendorRequest $request)
    {
        $logo = LogoVendor::find($id);

        $notification = array(
            'message' => 'هذا الشعار غير موجود',
            'alert-type' => 'error'
        );

        if (!$logo)
            return redirect()->route('index.logo.vendors')->with($notification);

        DB::beginTransaction();
//        $logo->update([
//            'vendor_id' => $request->vendor_id,
//        ]);


        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/vendors/logo/') . $logo->image->photo;
            unlink($image_path);
            $filePath = uploadImage('logo', $request->photo);
            $image = Image::where('imageable_id', $logo->id)->where('imageable_type','App\Models\LogoVendor')->update([
                'photo' => $filePath
            ]);
        }

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث الشعار بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.logo.vendors')->with($notification);
    }

    public function destroy($id)
    {

        $logo = LogoVendor::find($id);
        if (!$logo) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الشعار غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/vendors/logo/') . $logo->image->photo;
            unlink($image_path);
            $logo->delete();
            $logo->image->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الشعار بنجاح',
            ]);
        }


    }
}
