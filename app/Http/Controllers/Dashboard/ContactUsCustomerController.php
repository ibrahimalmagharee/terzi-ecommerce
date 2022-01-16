<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactCustomer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactUsCustomerController extends Controller
{
    public function contactUs(Request $request)
    {
        $contacts = ContactCustomer::all();

        if ($request->ajax()) {

            return DataTables::of($contacts)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn =  ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteContactUsCustomer" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.customers.contactUs.contactUsEmail',compact('contacts'));
    }

    public function destroyContactUs($id)
    {
        $contact = ContactCustomer::find($id);
        if (!$contact) {
            return response()->json([
                'status' => false,
                'msg' => 'هذه الرسالة غير موجودة',
            ]);
        } else {
            $contact->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الرسالة بنجاح',
            ]);
        }


    }
}
