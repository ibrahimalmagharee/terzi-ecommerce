<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ChangePasswordVendorRequest;
use App\Http\Requests\Dashboard\EditVendorRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Models\Image;
use App\Models\Vendor;
use App\Models\VendorHeaderCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use DB;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors= Vendor::get();

        if ($request->ajax()) {

            return DataTables::of($vendors)
                ->addIndexColumn()

                ->addColumn('changePassword', function ($row) {
                   // $url = route('change.password.vendor', $row->id);
                    $btn = ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تغيير كلمة المرور" class="btn btn-outline-warning box-shadow-3 mb-1 changePasswordVendor">تغيير كلمة المرور</a></td>';

                    return $btn;
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.vendor', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editVendor" class="primary box-shadow-3 mb-1 editBrand" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteVendor" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action','changePassword'])
                ->make(true);


        }
        return view('admin.vendors.index', compact('vendors'));
    }

    public function store(VendorRequest $request)
    {
        DB::beginTransaction();
        $vendor = Vendor::create([
            'name' => $request->name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
            'password' => bcrypt($request->password),

        ]);

        $vendor->save();

        $header_cover = VendorHeaderCover::create([
            'vendor_id' => $vendor->id,
            'photo' => 'companyprofile1.png'
        ]);

        $header_cover->save();

        $image = Image::create([
            'photo' => 'user-profile.png'
        ]);
        $vendor->image()->save($image);
        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة التاجر بنجاح'
        ]);
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()-> route('index.vendors')->with($notification);

        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update($id, EditVendorRequest $request)
    {
        $vendor = Vendor::find($id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()-> route('index.vendors')->with($notification);

        $vendor->where('id', $id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/vendors/profile/') . $vendor->image->photo;
            if ($vendor->image->photo != 'user-profile.png') {
                unlink($image_path);
            }
            $filePath = uploadImage('profile', $request->photo);
            $image = Image::where('imageable_id', $vendor->id)->where('imageable_type','App\Models\Vendor')->update([
                'photo' => $filePath
            ]);
        }

        $notification = array(
            'message' => 'تم تحديث التاجر بنجاح',
            'alert-type' => 'info'
        );

        return redirect()-> route('index.vendors')->with($notification);
    }

    public function destroy($id)
    {

        $vendor = Vendor::find($id);
        if (!$vendor){
            return response() -> json([
                'status' => false,
                'msg' => 'فشلت عملية حذف التاجر',
            ]);
        }

        else
        {
            $image_path = public_path('assets/images/vendors/profile/') . $vendor->image->photo;
            if ($vendor->image->photo != 'user-profile.png') {
                unlink($image_path);
            }
            $vendor->delete();
            return response() -> json([
                'status' => true,
                'msg' => 'تم حذف التاجر بنجاح',
            ]);
        }



    }

    public function changePassword(ChangePasswordVendorRequest $request)
    {
        $vendor = Vendor::where('id', $request->id)->first();
        if (Hash::check($request->input('old_password'), $vendor->password)) {
            $vendor->where('id', $vendor->id)->update([
                'password' => bcrypt($request->new_password)
            ]);

            return response() -> json([
                'status' => true,
                'msg' => 'تم تغيير كلمة المرور بنجاح',
            ]);


        } else {
            return response() -> json([
                'status' => false,
                'msg' => 'كلمة المرور القديمة غير صحيحة ',
            ]);

        }

    }
}
