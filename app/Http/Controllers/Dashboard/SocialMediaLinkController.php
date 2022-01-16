<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SocialMediaLinkRequest;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class SocialMediaLinkController extends Controller
{
    public function index(Request $request)
    {
        $links = SocialMediaLink::all();
        if ($request->ajax()) {

            return DataTables::of($links)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $url = route('edit.social_media_link', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editSocialMediaLink" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteSocialMediaLink" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.socialMediaLink.index');
    }


    public function edit($id)
    {
        $link = SocialMediaLink::find($id);

        $notification = array(
            'message' => 'هذا الرابط غير موجود',
            'alert-type' => 'error'
        );

        if (!$link)
            return redirect()->route('index.social_media_link')->with($notification);


        return view('admin.socialMediaLink.edit', compact('link'));
    }

    public function update($id, SocialMediaLinkRequest $request)
    {
        $link = SocialMediaLink::find($id);

        $notification = array(
            'message' => 'هذا الرابط غير موجود',
            'alert-type' => 'error'
        );

        if (!$link)
            return redirect()->route('index.social_media_link')->with($notification);

        DB::beginTransaction();
        $link->update([
            'link' => $request->link,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث الرابط بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.social_media_link')->with($notification);
    }

    public function destroy($id)
    {

        $link = SocialMediaLink::find($id);
        if (!$link) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الرابط غير موجود',
            ]);
        } else {
            $link->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الرابط بنجاح',
            ]);
        }


    }
}
