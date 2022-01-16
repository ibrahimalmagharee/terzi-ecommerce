<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SizeRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function index(Request $request, $customer_id)
    {
        $sizes = Size::where('customer_id', $customer_id)->get();

        $customer = Customer::find($customer_id);

        $categories = Category::active()->select('id','name')->where('parent_id', 2)->get();

        if ($request->ajax()) {

            return DataTables::of($sizes)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })

                ->addColumn('customer', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('action', function ($row) {
                    $url = route('size.edit.customer', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editSize" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteSize" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.customers.sizes.index', compact('sizes', 'customer','categories'));
    }

    public function store(SizeRequest $request)
    {

        $size = Size::create([
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

        $size->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المقاس بنجاح'
        ]);
    }

    public function edit($id)
    {
        $size = Size::find($id);
        $customer = Customer::find($size->customer_id);

        $categories = Category::active()->select('id','name')->where('parent_id', 2)->get();
        $notification = array(
            'message' => 'هذا المقاس غير موجود',
            'alert-type' => 'error'
        );
        if (!$size)
            return redirect()->route('size.customer.index', $size->customer_id)->with($notification);

        return view('admin.customers.sizes.edit', compact('size','categories'));
    }

    public function update($id, SizeRequest $request)
    {
        $size = Size::find($id);

        $notification = array(
            'message' => 'هذا المقاس غير موجود',
            'alert-type' => 'error'
        );
        if (!$size)
            return redirect()->route('size.customer.index', $size->customer_id)->with($notification);

        $size->where('id', $id)->update([
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

        $notification = array(
            'message' => 'تم تحديث المقلس بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('size.customer.index', $size->customer_id)->with($notification);
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
