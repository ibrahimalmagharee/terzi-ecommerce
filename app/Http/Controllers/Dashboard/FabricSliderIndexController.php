<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FabricSliderIndexRequest;
use App\Models\FabricSliderIndex;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class FabricSliderIndexController extends Controller
{
    public function index(Request $request)
    {
        $fabric_slider = FabricSliderIndex::all();
        if ($request->ajax()) {

            return DataTables::of($fabric_slider)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.fabric_slider', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editFabricSliderIndex" class="primary box-shadow-3 mb-1 editFabricSliderIndex" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteFabricSliderIndex" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.indexPage.fabricSlider.index');
    }

    public function store(FabricSliderIndexRequest $request)
    {
        DB::beginTransaction();
        $fabric_slider = FabricSliderIndex::create([
            'header' => $request->header,
            'description' => $request->description,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('fabricSlider', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $fabric_slider->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة بنجاح'
        ]);
    }

    public function edit($id)
    {
        $fabric_slider = FabricSliderIndex::find($id);

        $notification = array(
            'message' => 'هذا السلايدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric_slider)
            return redirect()->route('index.fabric_slider')->with($notification);

        return view('admin.indexPage.fabricSlider.edit', compact('fabric_slider'));
    }

    public function update($id, FabricSliderIndexRequest $request)
    {
        $fabric_slider = FabricSliderIndex::find($id);

        $notification = array(
            'message' => 'هذا السلايدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric_slider)
            return redirect()->route('index.fabric_slider')->with($notification);

        DB::beginTransaction();
        $fabric_slider->where('id', $id)->update([
            'header' => $request->header,
            'description' => $request->description,

        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/index/fabricSlider/') . $fabric_slider->image->photo;
            unlink($image_path);
            $filePath = uploadImage('fabricSlider', $request->photo);
            $image = Image::where('imageable_id', $fabric_slider->id)->where('imageable_type', 'App\Models\FabricSliderIndex')->update([
                'photo' => $filePath
            ]);
        }


        DB::commit();

        $notification = array(
            'message' => 'تم التحديث بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.fabric_slider')->with($notification);
    }

    public function destroy($id)
    {
        $fabric_slider = FabricSliderIndex::find($id);

        if (!$fabric_slider) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا السلايدر غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/index/fabricSlider/') . $fabric_slider->image->photo;
            unlink($image_path);
            $fabric_slider->delete();
            $fabric_slider->image->delete();


            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف بنجاح',
            ]);
        }


    }
}
