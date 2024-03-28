<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function list_products(Request $request) {
        $config = 'dashboard.products.index';
        $auth = auth()->user();
        $products = Product::orderBy('id','DESC')
            ->when($request->status != null, function($q) use($request) {
                if($request->status == 'show') {
                    return $q->where('status', 1);
                } elseif($request->status == 'hidden') {
                    return $q->where('status', 0);
                }
            })
            ->when($request->type_product != null, function($q) use($request) {
                $type = ProductType::where('slug', $request->type_product)->first();
                return $q->where('type_id', $type->id);
            })
            ->when($request->object_status != null, function ($q) use($request) {
                if($request->object_status == 'in-stock') {
                    return $q->where('quantity', ">", 0);
                } elseif( $request->object_status == 'sold-out') {
                    return $q->where('quantity', '=', 0);
                }
            })
            ->when($request->keywords != null, function ($q) use($request) {
                $keywords = $request->keywords;
                return $q->where('name','LIKE','%'. $keywords .'%');
            })
            ->paginate(20);
        $types = ProductType::orderBy('name','ASC')->get();
        return view('dashboard.layout', compact('config','auth','products','types'));
    }

    public function list_types(Request $request) {
        $config = 'dashboard.products.types';
        $auth = auth()->user();
        $types = ProductType::orderBy('id','DESC')
            ->when($request->object_status != null, function ($q) use($request) {
                if($request->object_status == 'show') {
                    return $q->where('object_status', 1);
                } elseif( $request->object_status == 'hidden') {
                    return $q->where('object_status', 0);
                }
            })
            ->when($request->status != null, function ($q) use($request) {
                if($request->status == 'in-stock') {
                    return $q->whereHas('update_status_products');
                } elseif( $request->status == 'sold-out') {
                    return $q->whereDoesntHave('update_status_products');
                }
            })
            ->when($request->keywords != null, function($q) use($request) {
                $keyword = $request->keywords;
                return $q->where('name','like',"%$keyword%");
            })
            ->paginate(10);
        return view('dashboard.layout', compact('config','auth','types'));
    }

    public function product_details ($id) {
        $config = 'dashboard.products.product-details';
        $auth = auth()->user();
        $details = Product::where('id', $id)->first();
        return view('dashboard.layout', compact('config','auth','details'));
    }

    public function edit_product($id) {
        $config = 'dashboard.products.edit-product';
        $auth = auth()->user();
        $types = ProductType::orderBy('id','ASC')->get();
        $details = Product::where('id', $id)->first();
        return view('dashboard.layout', compact('config','auth','details','types'));
    }

    public function create_product(Request $request) {
        $config = 'dashboard.products.create-product';
        $auth = auth()->user();
        $types = ProductType::orderBy('name','ASC')->get();
        return view('dashboard.layout', compact('config','auth','types'));
    }

    public function post_create_product(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
            'type_id' => 'required|exists:product_types,id',
            'info' => 'required|string',
            'describe' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'img' => 'required|image',
        ]);

        if (!$request->hasFile('img') || !$request->file('img')->isValid()) {
            return redirect()->back()->with('error', 'Hình ảnh không hợp lệ');
        }

        $data = $request->only('name','slug','type_id','info','describe','quantity','price');
        $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
        $request->img->storeAs('images/products', $img_name, 'public');
        $data['img'] = $img_name;
        $check = Product::create($data);
        if($check) {
            return redirect()->route('dashboard.products.list-products')->with('success','Tạo sản phẩm thành công');
        }
        return redirect()->back()->with('error','Tạo sản phẩm không thành công');
    }

    public function update_sort_order_img_details(Request $request) {
        if ($request->has('orders')) {
            $orders = $request->input('orders');
            $successMsg = '';
            foreach ($orders as $imgId => $sort_order) {
                ImgProduct::where('id', $imgId)->update(['sort_order' => $sort_order]);
                $successMsg .= "Ảnh có ID $imgId: cập nhật thứ tự thành $sort_order. ";
            }
            return response()->json(['message' => 'Cập nhật thứ tự thành công'], 200);
        }
        return response()->json(['error' => 'Không có hình nào được cập nhật thứ tự.'], 500);
    }

    public function post_edit_product($id, Request $request) {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
            'type_id' => 'required|numeric',
            'info' => 'required|string',
            'describe' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'img' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg', function($attr,$value,$fail) use($request) {
                if($value != null) {
                    if($request->hasAny('img')) {
                        $file = $request->file('img');
                        if(!$file->isValid()) {
                            return $fail('Invalid photo');
                        }
                    } else {
                        if (!$request->exists('img')) {
                            return $fail('Image is not exist');
                        }
                    }
                }
            }],
        ]);
        $product = Product::where('id', $id)->first();
        if($product) {
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->type_id = $request->type_id;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->quantity = $request->quantity;
            $product->info = $request->info;
            $product->describe = $request->describe;

            if($request->img != null) {
                $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
                $request->img->storeAs('images/products', $img_name, 'public');
                $product->img = $img_name;
            }

            $check = $product->save();
            if($check) {
                return redirect()->back()->with('success','Cập nhật sản phẩm thành công');
            }
            return redirect()->back()->with('error','Cập nhật sản phẩm thất bại');

        }
        return redirect()->back()->with('error','Không tìm thấy sản phẩm');
    }

    public function update_status_product($id) {
        $product = Product::find($id);
        if($product) {
            if($product->status == 1) {
                $product->status = 0;
            } else {
                $product->status = 1;
            }
            $product->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái sản phẩm thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
    }

    public function create_product_type() {
        $config = 'dashboard.products.create-type';
        $auth = auth()->user();
        return view('dashboard.layout', compact('config','auth'));
    }

    public function post_create_product_type(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
        ]);
        $data = $request->only('name','slug');
        $type = ProductType::create($data);
        if($type) {
            return redirect()->route('dashboard.products.list-types')->with('success','Tạo loại sản phẩm thành công');
        }
        return redirect()->back()->with('error','Không thể tạo loại sản phẩm');
    }

    public function edit_product_type($id) {
        $config = 'dashboard.products.edit-type';
        $auth = auth()->user();
        $type = ProductType::find($id);
        return view('dashboard.layout', compact('config','auth','type'));
    }

    public function post_edit_product_type($id, Request $request) {
        $request->validate([
            'name'=> 'required|string',
            'slug' => 'required',
        ]);
        $data = $request->only('name','slug');
        $type = ProductType::find($id);
        if($type) {
            $type->name = $data['name'];
            $type->slug = $data['slug'];
            $type->save();
            return redirect()->back()->with('success','Đổi thông tin thành công');
        }
        return redirect()->back()->with('error','Đổi thông tin thất bại');
    }

    public function update_status_type($id) {
        $type = ProductType::find($id);
        if($type) {
            if($type->object_status == 1) {
                $type->object_status = 0;
                $products = $type->update_status_products;
                foreach($products as $product) {
                    $product->status = 0;
                    $product->save();
                }
            } else {
                $type->object_status = 1;
                $products = $type->update_status_products;
                foreach($products as $product) {
                    $product->status = 1;
                    $product->save();
                }
            }
            $type->save();
            return response()->json(['success'=> true,'message'=> 'Thay đổi trạng thái loại sản phẩm thành công']);
        }
        return response()->json(['success'=> false, 'message'=> 'Không tìm thấy loại sản phẩm']);
    }

    public function update_img_details($id, Request $request) {
        $product = Product::find($id);
        if($product) {
            if($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $imageName = Str::random(32).".".$image->getClientOriginalExtension();
                    $image->storeAs('images/products', $imageName, 'public');
                    ImgProduct::create([
                        'img' => $imageName,
                        'product_id' => $product->id,
                    ]);
                }
                return redirect()->back()->with('success','Thêm hình ảnh chi tiết thành công');
            }
            return redirect()->back()->with('error','Không tìm thấy file');
        }
        return redirect()->back()->with('error','Không tìm thấy sản phẩm');
    }
}
