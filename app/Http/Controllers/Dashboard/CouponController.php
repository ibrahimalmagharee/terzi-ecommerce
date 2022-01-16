<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Models\Coupon;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::get();
        $vendors = Vendor::select('id', 'name')->get();

        if ($request->ajax()) {

            return DataTables::of($coupons)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return $row->type == 1 ? 'نسبة' : 'قيمة ثابتة';
                })
                ->addColumn('vendor_id', function ($row) {
                    return $row->vendor->name;
                })
//                ->editColumn('end_datetime', function ($row) {
//                    return $row->end_datetime->format('Y-m-d');
//                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $status = '<input type="checkbox" name="status" value="1" id="switcheryColor4"
                       class="switchery active is_active" data-id="' . $row->id . '" data-color="success" checked >';
                    } else {
                        $status = '<input type="checkbox" name="status" value="0" id="switcheryColor4"
                       class="switchery active is_active" data-id="' . $row->id . '" data-color="success" >';
                    }

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $url = route('edit.coupon', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editCopon" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCopon" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action', 'status','end_datetime'])
                ->make(true);


        }
        return view('admin.coupons.index', compact('coupons', 'vendors'));
    }

    public function store(CouponRequest $request)
    {
        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $coupon = Coupon::create([
            'vendor_id' => $request->vendor_id,
            'code' => $request->code,
            'type' => $request->type,
            'percent_discount' => $request->percent_discount,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
        ]);

        $coupon->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة كود الخصم بنجاح'
        ]);
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $vendors = Vendor::select('id', 'name')->get();
        $notification = array(
            'message' => 'هذا الكود غير موجود',
            'alert-type' => 'error'
        );
        if (!$coupon)
            return redirect()->route('index.coupons')->with($notification);

        return view('admin.coupons.edit', compact('coupon', 'vendors'));
    }

    public function update($id, CouponRequest $request)
    {
        $coupon = Coupon::find($id);
        $notification = array(
            'message' => 'هذا الكود غير موجود',
            'alert-type' => 'error'
        );
        if (!$coupon)
            return redirect()->route('index.coupons')->with($notification);

        if (!$request->has('status')) {
            $request->request->add(['status' => 0]);

        } else {
            $request->request->add(['status' => 1]);

        }

        $coupon->where('id', $id)->update([
            'vendor_id' => $request->vendor_id,
            'code' => $request->code,
            'type' => $request->type,
            'percent_discount' => $request->percent_discount,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $request->status,
        ]);

        $notification = array(
            'message' => 'تم تحديث كود الخصم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.coupons')->with($notification);
    }

    public function destroy($id)
    {

        $coupon = Coupon::find($id);
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الكود غير موجود',
            ]);
        } else {
            $coupon->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الكود بنجاح',
            ]);
        }


    }

    public function updateStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->coupon_id);
        $coupon->status = $request->status;
        $coupon->save();

        $notification = array(
            'msg' => 'تم تحديث الحالة بنجاح',
            'alert-type' => 'info'
        );

        return response()->json($notification);
    }
}
