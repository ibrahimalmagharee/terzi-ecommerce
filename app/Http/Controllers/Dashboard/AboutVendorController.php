<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutVendorRequest;
use App\Models\AboutVendor;
use App\Models\Category;
use App\Models\Image;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AboutVendorController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();
        $abouts = AboutVendor::all();
        if ($request->ajax()) {

            return DataTables::of($abouts)
                ->addIndexColumn()
                ->addColumn('vendor_id', function ($row) {
                    return $row->vendor->name;
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.about.vendor', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editAboutVendor" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteAboutVendor" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['vendor_id', 'action'])
                ->make(true);

        }
        return view('admin.vendors.about.index', compact('data'));
    }

    public function store(AboutVendorRequest $request)
    {
        DB::beginTransaction();
        $about = AboutVendor::create([
            'about' => $request->about,
            'vendor_id' => $request->vendor_id,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('about', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $about->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة النبذة بنجاح'
        ]);
    }

    public function edit($id)
    {
        $about = AboutVendor::find($id);

        $notification = array(
            'message' => 'هذه النبذة غير موجوده',
            'alert-type' => 'error'
        );

        if (!$about)
            return redirect()->route('index.about.vendors')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->parent()->get();

        return view('admin.vendors.about.edit', compact('about', 'data'));
    }

    public function update($id, AboutVendorRequest $request)
    {
        $about = AboutVendor::find($id);

        $notification = array(
            'message' => 'هذه النبذة غير موجوده',
            'alert-type' => 'error'
        );

        if (!$about)
            return redirect()->route('index.about.vendors')->with($notification);

        DB::beginTransaction();
        $about->where('id', $id)->update([
            'about' => $request->about,
            'vendor_id' => $request->vendor_id,
        ]);


        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('about', $request->photo);
            $image = Image::where('imageable_id', $about->id)->where('imageable_type','App\Models\AboutVendor')->update([
                'photo' => $filePath
            ]);
        }

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث النبذة بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.about.vendors')->with($notification);
    }

    public function destroy($id)
    {

        $about = AboutVendor::find($id);
        if (!$about) {
            return response()->json([
                'status' => false,
                'msg' => 'هذه النبذة غير موجوده',
            ]);
        } else {
            $image_path = public_path('assets/images/vendors/about/') . $about->image->photo;
            unlink($image_path);
            $about->delete();
            $about->image->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف النبذة بنجاح',
            ]);
        }


    }

}
