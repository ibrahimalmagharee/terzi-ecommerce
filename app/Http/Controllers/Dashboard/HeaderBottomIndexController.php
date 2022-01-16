<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HeaderBottomIndexRequest;
use App\Models\HeaderBottomIndex;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class HeaderBottomIndexController extends Controller
{
    public function index(Request $request)
    {
        $header_bottom = HeaderBottomIndex::all();
        if ($request->ajax()) {

            return DataTables::of($header_bottom)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.header_bottom', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editHeaderBottomIndex" class="primary box-shadow-3 mb-1 editHeaderBottomIndex" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteHeaderBottomIndex" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.indexPage.bottomHeader.index');
    }

    public function store(HeaderBottomIndexRequest $request)
    {
        DB::beginTransaction();
        $header_bottom = HeaderBottomIndex::create([
            'type' => $request->type,
            'description' => $request->description,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('bottomHeader', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $header_bottom->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة بنجاح'
        ]);
    }

    public function edit($id)
    {
        $header_bottom = HeaderBottomIndex::find($id);

        $notification = array(
            'message' => 'هذا الهيدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$header_bottom)
            return redirect()->route('index.header_bottom')->with($notification);

        return view('admin.indexPage.bottomHeader.edit', compact('header_bottom'));
    }

    public function update($id, HeaderBottomIndexRequest $request)
    {
        $header_bottom = HeaderBottomIndex::find($id);

        $notification = array(
            'message' => 'هذا الهيدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$header_bottom)
            return redirect()->route('index.header_bottom')->with($notification);

        DB::beginTransaction();
        $header_bottom->where('id', $id)->update([
            'type' => $request->type,
            'description' => $request->description,

        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/index/bottomHeader/') . $header_bottom->image->photo;
            unlink($image_path);
            $filePath = uploadImage('bottomHeader', $request->photo);
            $image = Image::where('imageable_id', $header_bottom->id)->where('imageable_type', 'App\Models\HeaderBottomIndex')->update([
                'photo' => $filePath
            ]);
        }


        DB::commit();

        $notification = array(
            'message' => 'تم التحديث بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.header_bottom')->with($notification);
    }

    public function destroy($id)
    {
        $header_bottom = HeaderBottomIndex::find($id);

        if (!$header_bottom) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الهيدر غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/index/bottomHeader/') . $header_bottom->image->photo;
            unlink($image_path);
            $header_bottom->delete();
            $header_bottom->image->delete();


            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف بنجاح',
            ]);
        }


    }
}
