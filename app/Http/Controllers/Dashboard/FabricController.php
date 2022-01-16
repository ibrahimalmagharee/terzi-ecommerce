<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FabricRequest;
use App\Http\Resources\FabricResource;
use App\Models\BasketProduct;
use App\Models\Category;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class FabricController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::where('type_activity' ,'!=', 'تفصيل')->select('id', 'name')->get();
        $data['colors'] = Color::select('id','color')->get();
        $data['categories'] = Category::active()->select('id','name')->where('parent_id', 2)->get();
          $fabrics = Fabric::with('colors')->get();
           FabricResource::collection($fabrics);

        if ($request->ajax()) {

            return DataTables::of($fabrics)
                ->addIndexColumn()
                ->addColumn('colors',  function ($row){
                    return \GuzzleHttp\json_decode($row->colors->map(function ($color){
                        return $color->color;
                    }));
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
                    $url = route('edit.fabric', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editFabric" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteFabric" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['colors', 'category_id', 'price', 'offer', 'vendor_id', 'status', 'action'])
                ->make(true);

        }
        return view('admin.products.fabrics.index', compact( 'data'));
    }

    public function store(FabricRequest $request)
    {
        DB::beginTransaction();
        $fabric= Fabric::create([
            'name' => $request->name,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $photo) {
                $image = Image::create([
                    'photo' => $photo
                ]);
                $fabric->images()->save($image);
            }
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);
        $fabric->product()->save($product);

        $fabric->colors()->attach($request->colors);



        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المنتج بنجاح'
        ]);
    }

    public function edit($id)
    {
        $fabric = Fabric::find($id);

        $notification = array(
            'message' => 'هذا القماش غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric)
            return redirect()->route('index.fabrics')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::where('type_activity' ,'!=', 'تفصيل')->select('id', 'name')->get();
        $data['colors'] = Color::select('id', 'color')->get();
        $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();

        $fabric_colors = collect();
        foreach ($fabric->colors as $colors){
            $fabric_colors []= $colors;

        }

        return view('admin.products.fabrics.edit', compact('fabric', 'data','fabric_colors'));
    }

    public function update($id, FabricRequest $request)
    {
        $fabric = Fabric::find($id);

        $notification = array(
            'message' => 'هذا القماش غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric)
            return redirect()->route('index.fabrics')->with($notification);

        DB::beginTransaction();
        $fabric->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        if ($request->has('images') && count($request->images) > 0) {
            foreach ($fabric->images as $img){
                $image_path = public_path('assets/images/products/fabrics/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }

            foreach ($request->images as $photo) {
                $image = Image::where('imageable_id', $fabric->id)->where('imageable_type','App\Models\Fabric')->create([
                    'photo' => $photo
                ]);
                $fabric->images()->save($image);
            }
        }

        $product = Product::where('productable_id', $fabric->id)->where('productable_type','App\Models\Fabric')->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);

        $fabric->colors()->sync($request->colors);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث القماش بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.fabrics')->with($notification);
    }

    public function destroy($id)
    {

        $fabric = Fabric::find($id);
        if (!$fabric) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا القماش غير موجود',
            ]);
        } else {
            foreach ($fabric->images as $img){
                $image_path = public_path('assets/images/products/fabrics/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }
            $fabric->delete();
            $fabric->product->delete();
            $cart_product = BasketProduct::where('product_id', $fabric->product->id)->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف القماش بنجاح',
            ]);
        }


    }

    public function saveImagesOfDesignInFolder(Request $request)
    {
        try {
            $image = $request->file('dzfile');
            $fileName = uploadImage('fabrics', $image);

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
        $path = public_path('assets/images/products/fabrics/') . $filename;

        if (file_exists($path)) {
            unlink($path);
        }
        return $path;
    }
}
