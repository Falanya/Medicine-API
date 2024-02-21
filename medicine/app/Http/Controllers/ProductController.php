<?php

namespace App\Http\Controllers;

use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pros = Product::orderBy('id', 'DESC')->paginate(10);
        if($key = request('search')) {
            $pros = Product::orderBy('id', 'DESC')->where('name', 'like', '%'.$key.'%')->paginate(10);
        }

        return view('admin.product.index', compact('pros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        return view('admin.product.create', compact('proTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'slug' => 'required',
            'type_id' => 'required',
            'describe' => 'required',
            'info' => 'required',
            'price' => 'required|numeric',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'imgs' => 'required|array',
            'imgs.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required'
        ]);

        //dd($request->all());

        $fileName = Str::random(32). "." .$request->img->getClientOriginalExtension();
        $request->img->storeAs('public/images/products', $fileName);
        $data = $request->only('name', 'slug', 'type_id', 'describe', 'info', 'price', 'status');
        $data['img'] = $fileName;

        $product = Product::create($data);
        if($product && $request->hasFile('imgs')) {
            foreach($request->imgs as $key => $item) {
                $fileNames = Str::random(32). "." .$item->getClientOriginalExtension();
                $item->storeAs('public/images/products', $fileNames);
                ImgProduct::create([
                    'product_id' => $product->id,
                    'img' => $fileNames,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,

        ]);

        $data = $request->all('name', 'type_id', 'describe', 'info', 'price', 'img', 'status');
        $product->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
