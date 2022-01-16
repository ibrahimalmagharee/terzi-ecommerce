<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutUsRequest;
use App\Models\AboutUs;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $about_us = AboutUs::all();
        if ($request->ajax()) {

            return DataTables::of($about_us)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $url = route('edit.about', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editAbout" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteAboutUs" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.aboutus.index');
    }

    public function store(AboutUsRequest $request)
    {
        DB::beginTransaction();
        $about_us = AboutUs::create([
            'about' => $request->about,
            'link' => $request->link,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('aboutSite', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $about_us->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة النبذة بنجاح'
        ]);
    }

    public function edit($id)
    {
          $about_us = AboutUs::with('image')->find($id);
        $ext = '';
         if ($about_us->image != null){
             $ext =  pathinfo($about_us->image->photo, PATHINFO_EXTENSION);

         }


        $notification = array(
            'message' => 'هذه النبذة غير موجوده',
            'alert-type' => 'error'
        );

        if (!$about_us)
            return redirect()->route('index.about')->with($notification);

        return view('admin.aboutus.edit', compact('about_us', 'ext'));
    }

    public function update($id, AboutUsRequest $request)
    {
        $about_us = AboutUs::find($id);

        $notification = array(
            'message' => 'هذه النبذة غير موجوده',
            'alert-type' => 'error'
        );

        if (!$about_us)
            return redirect()->route('index.about')->with($notification);

        DB::beginTransaction();
        $about_us->where('id', $id)->update([
            'about' => $request->about,
            'link' => $request->link,

        ]);

        $filePath = "";
        if ($request->has('photo')) {
            if ($about_us->image != null){
                $image_path = public_path('assets/images/aboutSite/') . $about_us->image->photo;
                unlink($image_path);
                $filePath = uploadImage('aboutSite', $request->photo);
                $image = Image::where('imageable_id', $about_us->id)->where('imageable_type','App\Models\AboutUs')->update([
                    'photo' => $filePath
                ]);
            }else{
                $filePath = uploadImage('aboutSite', $request->photo);
                $image = Image::create([
                    'photo' => $filePath
                ]);
                $about_us->image()->save($image);
            }

        }



        if ($request->has('photo')) {
            $filePath = uploadImage('aboutSite', $request->photo);
            $image = Image::where('imageable_id', $about_us->id)->where('imageable_type','App\Models\AboutUs')->update([
                'photo' => $filePath
            ]);
        }

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث النبذة بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.about')->with($notification);
    }

    public function destroy($id)
    {

        $about_us = AboutUs::find($id);
        if (!$about_us) {
            return response()->json([
                'status' => false,
                'msg' => 'هذه النبذة غير موجوده',
            ]);
        } else {
            if ($about_us->image != null){
                $image_path = public_path('assets/images/aboutSite/') . $about_us->image->photo;
                unlink($image_path);
                $about_us->delete();
                $about_us->image->delete();

            }else{
                $about_us->delete();
            }
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف النبذة بنجاح',
            ]);
        }


    }
}
