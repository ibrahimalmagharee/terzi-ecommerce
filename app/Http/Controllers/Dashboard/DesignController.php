<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DesignRequest;
use App\Http\Resources\DesignResource;
use App\Http\Resources\ProductResource;
use App\Models\BasketProduct;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Design;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Type;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class DesignController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
         $data['vendors'] = Vendor::where('type_activity' ,'!=', 'أقمشة')->select('id', 'name')->get();
        $data['types'] = Type::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();
        $designs = Design::all();
        DesignResource::collection($designs);

        if ($request->ajax()) {

            return DataTables::of($designs)
                ->addIndexColumn()
                ->addColumn('type_id', function ($row) {
                    return $row->type->name;
                })
                ->addColumn('category_id', function ($row) {
                    return $row->product->category->name;
                })
                ->addColumn('price', function ($row) {
                    return $row->product->price;
                })
                ->addColumn('offer', function ($row) {
                    return $row->product->offer == '' ? 'لايوجد عرض' : $row->product->offer;
                })
                ->addColumn('vendor_id', function ($row) {
                    return $row->product->vendor->name;
                })

                ->addColumn('status', function ($row) {
                    $str = 'نشر';
                    $class = '';
                    $class1 = '';
                    if ($row->product->status == 0) {
                        $str = 'نشر';
                        $class = 'hidden';

                    } else {
                        $str = 'الغاء النشر';
                        $class1 = 'hidden';
                    }

                    return $status = '<td>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->product->status . '"  data-id="' . $row->product->id . '" id="un_published_' . $row->product->id . '"  class="btn btn-info box-shadow-3 mb-1 '.$class1.' changeStatus" style="width: 80px">نشر</a>
                        <a href="javascript:void(0)"  data-toggle="tooltip" data-status="' . $row->product->status . '"  data-id="' . $row->product->id . '" id="published_' . $row->product->id . '"  class="btn btn-warning box-shadow-3 mb-1 '.$class.' changeStatus" style="width: 85px">الغاء النشر</a>
                        </td>';
                })

                ->addColumn('action', function ($row) {
                    $url = route('edit.design', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editDesign" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger  box-shadow-3 mb-1 deleteDesign" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['type_id', 'category_id', 'price', 'offer', 'vendor_id', 'status', 'action'])
                ->make(true);

        }
        return view('admin.products.designs.index', compact('data'));
    }

    public function store(DesignRequest $request)
    {
        DB::beginTransaction();
        $design = Design::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $photo) {
                $image = Image::create([
                    'photo' => $photo
                ]);
                $design->images()->save($image);
            }
        }


        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);
        $design->product()->save($product);


        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المنتج بنجاح'
        ]);
    }

    public function edit($id)
    {
        $design = Design::find($id);

        $notification = array(
            'message' => 'هذا التفصيل غير موجود',
            'alert-type' => 'error'
        );

        if (!$design)
            return redirect()->route('index.designs')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::where('type_activity' ,'!=', 'أقمشة')->select('id', 'name')->get();
        $data['types'] = Type::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();

        return view('admin.products.designs.edit', compact('design', 'data'));
    }

    public function update($id, DesignRequest $request)
    {
        $design = Design::find($id);

        $notification = array(
            'message' => 'هذا التفصيل غير موجود',
            'alert-type' => 'error'
        );

        if (!$design)
            return redirect()->route('index.designs')->with($notification);

        DB::beginTransaction();
        $design->where('id', $id)->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($design->images as $img){
                $image_path = public_path('assets/images/products/designs/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }

            foreach ($request->images as $photo) {
                $image = Image::where('imageable_id', $design->id)->where('imageable_type','App\Models\Design')->create([
                    'photo' => $photo
                ]);
                $design->images()->save($image);
            }
        }


        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('designs', $request->photo);
            $image = Image::where('imageable_id', $design->id)->where('imageable_type','App\Models\Design')->update([
                'photo' => $filePath
            ]);
        }
        $product = Product::where('productable_id', $design->id)->where('productable_type','App\Models\Design')->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث التفصيل بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.designs')->with($notification);
    }

    public function changeStatus (Request $request)
    {
        $status = $request->status;
        $product = Product::where('id', request('product_id'))->first();
        if ($request->status == 0){
            $status = 1;
        }elseif ($request->status == 1) {
            $status = 0;
        }

        $product->where('id', request('product_id'))->update([
            'status' => $status
        ]);
        $product_type = $product->productable_type;


        return response()->json([
            'status' => true ,
            'product_status' => $status ,
            'product_type' => $product_type ,
            'msg' => 'تم تحديث حالة المنتج بنجاح'
        ]);
    }

    public function destroy($id)
    {

        $design = Design::find($id);
        if (!$design) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا التفصيل غير موجود',
            ]);
        } else {
            foreach ($design->images as $img){
                $image_path = public_path('assets/images/products/designs/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }

            $design->delete();
            $design->product->delete();
            $cart_product = BasketProduct::where('product_id', $design->product->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف المنتج بنجاح',
            ]);
        }


    }

    public function saveImagesOfDesignInFolder(Request $request)
    {
        try {
            $image = $request->file('dzfile');
            $fileName = uploadImage('designs', $image);

            return response()->json([
                'status' => true,
                'name' => $fileName,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية لبحفظ يرجى المحاولة مرة اخرى'
            ]);
        }
    }

    public function removeImagesOfDesignFromFolder(Request $request)
    {
        $image = $request->file('filename');
        $filename = $request->get('filename');
        $path = public_path('assets/images/products/designs/') . $filename;

        if (file_exists($path)) {
            unlink($path);
        }
        return $path;
    }
}
