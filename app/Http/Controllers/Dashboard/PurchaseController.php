<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesignResource;
use App\Models\Category;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Type;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function purchaseFabric(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();
        $purchases = Purchase::get();

        $product_id = [];

        foreach ($purchases as $purchase) {
            array_push($product_id, $purchase->product_id);
        }

        $products = Product::whereIn('id', $product_id)->get();

        $fabric_id = [];
        foreach ($products as $product) {

            if ($product->productable_type == 'App\Models\Fabric') {
                array_push($fabric_id, $product->productable_id);
            }
        }

        $fabrics = Fabric::whereIn('id', $fabric_id)->get();

        $purchases_fabric = [];
        foreach ($purchases as $purchase) {
            foreach ($products as $product) {
                if ($product->productable_type == 'App\Models\Fabric') {
                    if ($product->id == $purchase->product_id) {
                        array_push($purchases_fabric, $purchase);
                    }

                }
            }
        }

        $total_price = 0;

        foreach ($purchases_fabric as $purchase) {
            foreach ($products as $product) {
                foreach ($fabrics as $fabric) {
                    if ($fabric->id == $product->productable_id) {
                        if ($product->productable_type == 'App\Models\Fabric') {
                            if ($purchase->product_id == $product->id) {
                                if ($fabric->product->offer != ''){
                                    $total_price += (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $purchase->quantity) + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $purchase->number_of_meters;

                                } else {
                                    $total_price += ($fabric->product->price * $purchase->quantity) + ($fabric->product->price * $purchase->number_of_meters);
                                }


                            }
                        }
                    }
                }
            }

        }


        if ($request->ajax()) {

            return DataTables::of($purchases_fabric)
                ->addIndexColumn()
                ->addColumn('vendor', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Fabric') {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                    $purchases_fabric = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_fabric, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_fabric as $purchase) {
                        foreach ($products as $product) {
                            foreach ($fabrics as $fabric) {
                                if ($fabric->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Fabric') {
                                        if ($row->product_id == $product->id) {
                                            return $fabric->product->vendor->name;

                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('name', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Fabric') {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                    $purchases_fabric = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_fabric, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_fabric as $purchase) {
                        foreach ($products as $product) {
                            foreach ($fabrics as $fabric) {
                                if ($fabric->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Fabric') {
                                        if ($row->product_id == $product->id) {
                                            return $fabric->name;

                                        }
                                    }
                                }
                            }
                        }

                    }

                })
                ->addColumn('category', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Fabric') {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                    $purchases_fabric = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_fabric, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_fabric as $purchase) {
                        foreach ($products as $product) {
                            foreach ($fabrics as $fabric) {
                                if ($fabric->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Fabric') {
                                        if ($row->product_id == $product->id) {
                                            return $fabric->product->category->name;

                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('price', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Fabric') {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                    $purchases_fabric = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_fabric, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_fabric as $purchase) {
                        foreach ($products as $product) {
                            foreach ($fabrics as $fabric) {
                                if ($fabric->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Fabric') {
                                        if ($row->product_id == $product->id) {
                                            if ($fabric->product->offer != '') {
                                                return $fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer);
                                            } else {
                                                return $fabric->product->price;
                                            }


                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('number_of_meters', function ($row) {
                    return $row->number_of_meters;
                })

                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('total_price', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Fabric') {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                    $purchases_fabric = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_fabric, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_fabric as $purchase) {
                        foreach ($products as $product) {
                            foreach ($fabrics as $fabric) {
                                if ($fabric->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Fabric') {
                                        if ($row->product_id == $product->id) {
                                            if ($fabric->product->offer != '') {
                                                return ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->quantity + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->number_of_meters;
                                            } else {
                                                return ($fabric->product->price * $row->quantity) + ($fabric->product->price * $row->number_of_meters);
                                            }


                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->rawColumns(['price'])
                ->make(true);

        }


        return view('admin.purchase.fabric', compact('data','total_price'));

    }

    public function purchaseDesign(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();


        $purchases = Purchase::get();

        $product_id = [];

        foreach ($purchases as $purchase) {
            array_push($product_id, $purchase->product_id);
        }

        $products = Product::whereIn('id', $product_id)->get();

        $design_id = [];
        foreach ($products as $product) {

            if ($product->productable_type == 'App\Models\Design') {
                array_push($design_id, $product->productable_id);
            }
        }

        $designs = Design::whereIn('id', $design_id)->get();

        $purchases_design = [];
        foreach ($purchases as $purchase) {
            foreach ($products as $product) {
                if ($product->productable_type == 'App\Models\Design') {
                    if ($product->id == $purchase->product_id) {
                        array_push($purchases_design, $purchase);
                    }

                }
            }
        }

        $total_price = 0;

        foreach ($purchases_design as $purchase) {
            foreach ($products as $product) {
                foreach ($designs as $design) {
                    if ($design->id == $product->productable_id) {
                        if ($product->productable_type == 'App\Models\Design') {
                            if ($purchase->product_id == $product->id) {
                                if ($design->product->offer != ''){
                                    $total_price += ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $purchase->quantity;

                                } else {
                                    $total_price += $design->product->price * $purchase->quantity;
                                }

                            }
                        }
                    }
                }
            }

        }


        if ($request->ajax()) {

            return DataTables::of($purchases_design)
                ->addIndexColumn()
                ->addColumn('vendor', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        }
                    }
                    $designs = Design::whereIn('id', $design_id)->get();
                    $purchases_design = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_design, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_design as $purchase) {
                        foreach ($products as $product) {
                            foreach ($designs as $design) {
                                if ($design->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Design') {
                                        if ($row->product_id == $product->id) {
                                            return $design->product->vendor->name;

                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('name', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        }
                    }
                    $designs = Design::whereIn('id', $design_id)->get();
                    $purchases_design = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_design, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_design as $purchase) {
                        foreach ($products as $product) {
                            foreach ($designs as $design) {
                                if ($design->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Design') {
                                        if ($row->product_id == $product->id) {
                                            return $design->name;

                                        }
                                    }
                                }
                            }
                        }

                    }

                })
                ->addColumn('category', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        }
                    }
                    $designs = Design::whereIn('id', $design_id)->get();
                    $purchases_design = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_design, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_design as $purchase) {
                        foreach ($products as $product) {
                            foreach ($designs as $design) {
                                if ($design->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Design') {
                                        if ($row->product_id == $product->id) {
                                            return $design->product->category->name;

                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('price', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        }
                    }
                    $designs = Design::whereIn('id', $design_id)->get();
                    $purchases_design = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_design, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_design as $purchase) {
                        foreach ($products as $product) {
                            foreach ($designs as $design) {
                                if ($design->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Design') {
                                        if ($row->product_id == $product->id) {
                                            if ($design->product->offer != '') {
                                                return $design->product->price - (($design->product->price / 100) * $design->product->offer);
                                            } else {
                                                return $design->product->price;
                                            }

                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('total_price', function ($row) {
                    $purchases = Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        }
                    }
                    $designs = Design::whereIn('id', $design_id)->get();
                    $purchases_design = [];
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id) {
                                    array_push($purchases_design, $purchase);
                                }

                            }
                        }
                    }
                    foreach ($purchases_design as $purchase) {
                        foreach ($products as $product) {
                            foreach ($designs as $design) {
                                if ($design->id == $product->productable_id) {
                                    if ($product->productable_type == 'App\Models\Design') {
                                        if ($row->product_id == $product->id) {
                                            if ($design->product->offer != '') {
                                                return ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $row->quantity;
                                            } else {
                                                return $design->product->price * $row->quantity;
                                            }


                                        }
                                    }
                                }
                            }
                        }

                    }
                })
                ->rawColumns(['price'])
                ->make(true);

        }

        return view('admin.purchase.design', compact('data','total_price'));

    }

}
