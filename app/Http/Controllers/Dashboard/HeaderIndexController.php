<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HeaderIndexRequest;
use App\Models\HeaderIndex;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class HeaderIndexController extends Controller
{
    public function index(Request $request)
    {
        $header_index = HeaderIndex::all();
        if ($request->ajax()) {

            return DataTables::of($header_index)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.header_index', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editHeaderIndex" class="primary box-shadow-3 mb-1 editHeaderIndex" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteHeaderIndex" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.indexPage.topHeader.index');
    }

    public function store(HeaderIndexRequest $request)
    {
        DB::beginTransaction();
        $header_index = HeaderIndex::create([
            'header' => $request->header,
            'description' => $request->description,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('topHeader', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $header_index->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة بنجاح'
        ]);
    }

    public function edit($id)
    {
        $header_index = HeaderIndex::find($id);

        $notification = array(
            'message' => 'هذا الهيدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$header_index)
            return redirect()->route('index.header_index')->with($notification);

        return view('admin.indexPage.topHeader.edit', compact('header_index'));
    }

    public function update($id, HeaderIndexRequest $request)
    {
        $header_index = HeaderIndex::find($id);

        $notification = array(
            'message' => 'هذا الهيدر غير موجود',
            'alert-type' => 'error'
        );

        if (!$header_index)
            return redirect()->route('index.header_index')->with($notification);

        DB::beginTransaction();
        $header_index->where('id', $id)->update([
            'header' => $request->header,
            'description' => $request->description,

        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/index/topHeader/') . $header_index->image->photo;
            unlink($image_path);
            $filePath = uploadImage('topHeader', $request->photo);
            $image = Image::where('imageable_id', $header_index->id)->where('imageable_type', 'App\Models\HeaderIndex')->update([
                'photo' => $filePath
            ]);
        }


        DB::commit();

        $notification = array(
            'message' => 'تم التحديث بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.header_index')->with($notification);
    }

    public function destroy($id)
    {
        $header_index = HeaderIndex::find($id);

        if (!$header_index) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الهيدر غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/index/topHeader/') . $header_index->image->photo;
            unlink($image_path);
            $header_index->delete();
            $header_index->image->delete();


            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف بنجاح',
            ]);
        }


    }
}
