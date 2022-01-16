<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TermsAndConditionsRequest;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TermsAndConditionsController extends Controller
{
    public function index(Request $request)
    {
        $term_conditions = TermsAndConditions::all();
        if ($request->ajax()) {

            return DataTables::of($term_conditions)
                ->addIndexColumn()

                ->editColumn('description', function ($row){
                    return  'الشروط و الأحكام ...';
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.term_condition', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editTermsAndConditions" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';

                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteTermsAndConditions" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="info box-shadow-3 mb-1 viewTermsAndConditions" style="width: 80px"><i class="la la-eye font-large-1"></i></a></td>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.termConditions.index');
    }

    public function viewTermsAndConditions (Request $request)
    {
        $term_condition = TermsAndConditions::find($request->id);

        return response()->json($term_condition);

    }

    public function store(TermsAndConditionsRequest $request)
    {
        DB::beginTransaction();

        $term_condition = TermsAndConditions::create([
            'description' => $request->description,
        ]);



        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة الشروط و الأحكام بنجاح'
        ]);
    }

    public function edit($id)
    {
        $term_condition = TermsAndConditions::find($id);

        $notification = array(
            'message' => 'هذه الشروط و الأحكام غير موجوده',
            'alert-type' => 'error'
        );

        if (!$term_condition)
            return redirect()->route('index.term_condition')->with($notification);


        return view('admin.termConditions.edit', compact('term_condition'));
    }

    public function update($id, TermsAndConditionsRequest $request)
    {
        $term_condition = TermsAndConditions::find($id);

        $notification = array(
            'message' => 'هذه الشروط و الأحكام غير موجوده',
            'alert-type' => 'error'
        );

        if (!$term_condition)
            return redirect()->route('index.term_condition')->with($notification);

        DB::beginTransaction();
        $term_condition->update([
            'description' => $request->description,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث الشروط و الأحكام بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.term_condition')->with($notification);
    }

    public function destroy($id)
    {

        $term_condition = TermsAndConditions::find($id);
        if (!$term_condition) {
            return response()->json([
                'status' => false,
                'msg' => 'هذه الشروط و الأحكام غير موجوده',
            ]);
        } else {
            $term_condition->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الشروط و الأحكام بنجاح',
            ]);
        }


    }
}
