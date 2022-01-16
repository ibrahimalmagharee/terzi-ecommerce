<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContentCenterDesignIndexRequest;
use App\Models\ContentCenterDesignIndex;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ContentCenterDesignIndexController extends Controller
{
    public function index(Request $request)
    {
        $content_center_design = ContentCenterDesignIndex::all();
        if ($request->ajax()) {

            return DataTables::of($content_center_design)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.content_center_design', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editContentCenterDesignIndex" class="primary box-shadow-3 mb-1 editContentCenterDesignIndex" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteContentCenterDesignIndex" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.indexPage.contentCenterDesign.index');
    }

    public function store(ContentCenterDesignIndexRequest $request)
    {
        DB::beginTransaction();
        $content_center_design = ContentCenterDesignIndex::create([
            'header' => $request->header,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('contentCenterDesign', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $content_center_design->image()->save($image);
        }

        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة بنجاح'
        ]);
    }

    public function edit($id)
    {
        $content_center_design = ContentCenterDesignIndex::find($id);

        $notification = array(
            'message' => 'هذا المحتوى غير موجود',
            'alert-type' => 'error'
        );

        if (!$content_center_design)
            return redirect()->route('index.content_center_design')->with($notification);

        return view('admin.indexPage.contentCenterDesign.edit', compact('content_center_design'));
    }

    public function update($id, ContentCenterDesignIndexRequest $request)
    {
        $content_center_design = ContentCenterDesignIndex::find($id);

        $notification = array(
            'message' => 'هذا المحتوى غير موجود',
            'alert-type' => 'error'
        );

        if (!$content_center_design)
            return redirect()->route('index.content_center_design')->with($notification);

        DB::beginTransaction();
        $content_center_design->where('id', $id)->update([
            'header' => $request->header,

        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $image_path = public_path('assets/images/index/contentCenterDesign/') . $content_center_design->image->photo;
            unlink($image_path);
            $filePath = uploadImage('contentCenterDesign', $request->photo);
            $image = Image::where('imageable_id', $content_center_design->id)->where('imageable_type', 'App\Models\ContentCenterDesignIndex')->update([
                'photo' => $filePath
            ]);
        }


        DB::commit();

        $notification = array(
            'message' => 'تم التحديث بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.content_center_design')->with($notification);
    }

    public function destroy($id)
    {
        $content_center_design = ContentCenterDesignIndex::find($id);

        if (!$content_center_design) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا المحتوى غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/index/contentCenterDesign/') . $content_center_design->image->photo;
            unlink($image_path);
            $content_center_design->delete();
            $content_center_design->image->delete();


            return response()->json([
                'status' => true,
                'msg' => 'تم الحذف بنجاح',
            ]);
        }


    }
}
