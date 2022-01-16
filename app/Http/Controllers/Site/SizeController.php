<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SizeRequest;
use App\Models\Category;
use App\Models\Logo;
use App\Models\Size;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function index (Request $request)
    {
        $customer_id = auth('customer')->user()->id;

        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();
         $sizes = Size::where('customer_id', $customer_id)->get();
        $categories = Category::active()->select('id','name')->where('parent_id', 2)->get();

        if ($request->ajax()) {

            return DataTables::of($sizes)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })

                ->addColumn('action', function ($row) {
                    $url = route('size.edit.customer', $row->id);
                    $btn = '<td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="btn btn-info box-shadow-3 mb-1 editSize" ><i class="fa fa-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="btn btn-danger box-shadow-3 mb-1 deleteSize"><i class="fa fa-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.sizes', compact('sizes','categories','customer_id', 'basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.customer.sizes', compact('sizes','categories','customer_id', 'social_media_link', 'logo'));
        }

    }

    public function edit (Request $request)
    {
         $size = Size::find($request->id);
        return response()->json($size);
    }

    public function update(SizeRequest $request)
    {
        $size = Size::find($request->id);

        $size->where('id', $request->id)->update([
            'customer_id' => $request->customer_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'chest_circumference' => $request->chest_circumference,
            'waistline' => $request->waistline,
            'buttock_circumference' => $request->buttock_circumference,
            'length_by_chest' => $request->length_by_chest,
            'chest_length' => $request->chest_length,
            'shoulder_length' => $request->shoulder_length,
            'back_view' => $request->back_view,
            'neck_length' => $request->neck_length,
            'neck_width' => $request->neck_width,
            'neck_circumference' => $request->neck_circumference,
            'distance_between_breasts' => $request->distance_between_breasts,
            'arm_length' => $request->arm_length,
            'arm_circumference' => $request->arm_circumference,
            'armpit_length' => $request->armpit_length,
        ]);

        return response()->json([
            'status' => true,
            'msg' => 'تم تحديث المقاس بنجاح'
        ]);
    }

    public function destroy(Request $request)
    {

        $size = Size::find($request->id);
        if (!$size){
            return response()->json([
                'status' => false,
                'msg' => 'هذا المقاس غير موجود',
            ]);
        } else {
            $size->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف المقاس بنجاح',
            ]);
        }


    }
}
