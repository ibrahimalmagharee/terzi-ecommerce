<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UsagePolicyRequest;
use App\Models\TermsAndConditions;
use App\Models\UsagePolicy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class UsagePolicyController extends Controller
{
    public function index(Request $request)
    {
        $usage_policy = UsagePolicy::all();
        if ($request->ajax()) {

            return DataTables::of($usage_policy)
                ->addIndexColumn()

                ->editColumn('description', function ($row){
                    return  'سياسة الاستخدام ...';
                })


                ->addColumn('action', function ($row) {
                    $url = route('edit.usage_policy', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editUsagePolicy" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteUsagePolicy" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="info box-shadow-3 mb-1 viewUsagePolicy" style="width: 80px"><i class="la la-eye font-large-1"></i></a></td>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.usagePolicy.index');
    }

    public function viewUsagePolicy (Request $request)
    {
        $usage_policy = UsagePolicy::find($request->id);

        return response()->json($usage_policy);

    }

    public function store(UsagePolicyRequest $request)
    {
        DB::beginTransaction();

        $usage_policy = UsagePolicy::create([
            'description' => $request->description,
        ]);



        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة سياسة الاستخدام بنجاح'
        ]);
    }

    public function edit($id)
    {
        $usage_policy = UsagePolicy::find($id);

        $notification = array(
            'message' => 'هذه سياسة الاستخدام غير موجوده',
            'alert-type' => 'error'
        );

        if (!$usage_policy)
            return redirect()->route('index.usage_policy')->with($notification);


        return view('admin.usagePolicy.edit', compact('usage_policy'));
    }

    public function update($id, UsagePolicyRequest $request)
    {
        $usage_policy = UsagePolicy::find($id);

        $notification = array(
            'message' => 'هذه سياسة الاستخدام غير موجوده',
            'alert-type' => 'error'
        );

        if (!$usage_policy)
            return redirect()->route('index.usage_policy')->with($notification);

        DB::beginTransaction();
        $usage_policy->update([
            'description' => $request->description,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث سياسة الاستخدام بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.usage_policy')->with($notification);
    }

    public function destroy($id)
    {

        $usage_policy = UsagePolicy::find($id);
        if (!$usage_policy) {
            return response()->json([
                'status' => false,
                'msg' => 'هذه سياسة الاستخدام غير موجوده',
            ]);
        } else {
            $usage_policy->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف سياسة الاستخدام بنجاح',
            ]);
        }


    }
}
