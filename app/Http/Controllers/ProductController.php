<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Asegúrate de que sea all() y no paginate()
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(ProductRequest $request)
    {
        $uploadType = $request->input('upload_type');
        $imagename = "";

        if ($uploadType === 'file') {
            $image = $request->file('image_file');
            if (isset($image)) {
                $slug = Str::slug($request->name);
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                if (!file_exists('uploads/products')) {
                    mkdir('uploads/products', 0777, true);
                }
                $image->move('uploads/products', $imagename);
            }
        } else if ($uploadType === 'url') {
            $imageUrl = $request->input('image_url');
            if (!empty($imageUrl)) {
                $imagename = $imageUrl;
            }
        }


        $product = new Product();
        $product->name = $request->name;
        $product->image = $imagename;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = 1;
        $product->registered_by = $request->user()->id;
        $product->save();


        return redirect()->route("products.index")->with("success", "Product successfully added.");
    }


    public function show(string $id)
    {

    }


    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("products.edit", compact("product"));
    }


    public function update(ProductRequest $request, string $id)
    {
        //

        $product = Product::find($id);

        $image = $request->file('image');
        $slug = str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/products')) {
                mkdir('uploads/products', 0777, true);
            }
            $image->move('uploads/products', $imagename);
        } else {
            $imagename = $product->image;
        }


        $product->name = $request->name;
        $product->image = $imagename;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->registered_by = $request->user()->id;
        $product->save();

        return redirect()->route('products.index')->with('successMsg', 'El registro se actualizó exitosamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("products.index")->with("success", "The product has been deleted.");
    }

    public function changeproducturl(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
    }
}
