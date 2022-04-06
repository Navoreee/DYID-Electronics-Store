<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected function validateProduct(Request $request)
    {
        $request->validate([
            'name'          =>  'required|unique:products|min:5',
            'description'   =>  'required|min:50',
            'price'         =>  'required|numeric|gt:0',
            'category'      =>  'required',
            'image'         =>  'required|mimes:jpg',
        ]);
    }

    public function showProductsHome()
    {
        $products = Product::paginate(6);
        return view('home', compact('products'));
    }

    public function showProductDetails($id)
    {
        $product = Product::where('id','=',$id)->first();
        return view('product_detail', compact('product'));
    }

    public function searchProduct(Request $request)
    {
        $query = $request['query'];
        $products = Product::where('name','LIKE','%'.$query.'%')->paginate(6);

        return view('home', compact('products'));
    }

    public function showProductsAdmin()
    {
        $products = Product::paginate(10);
        return view('admin.view_product', compact('products'));
    }

    public function showAddProductForm()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $this->validateProduct($request);

        $image_name = uniqid().'.jpg';
        
        $request->image->move('storage/product', $image_name);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->image_path = $image_name;
        $product->save();

        return redirect()->back()->with('message', 'Product successfully added.');
    }

    public function showEditProductForm($id)
    {
        $categories = Category::all();
        $product = Product::where('id','=',$id)->first();
        return view('admin.edit_product', compact('categories','product'));
    }

    public function updateProduct(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => [
                'required',
                'min:5',
                Rule::unique('products')->ignore($id),
            ],
            'description'   =>  'required|min:50',
            'price'         =>  'required|numeric|gt:0',
            'category'      =>  'required',
            'image'         =>  'mimes:jpg',
        ]);

        
        $product = Product::where('id','=',$id)->first();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if ($request->image) {
            // Storage::disk('public')->delete('product/'.$product->image_path);
            $image_name = uniqid().'.jpg';
            $request->image->move('storage/product', $image_name);
            $product->image_path = $image_name;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product successfully updated.');
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::where('id','=',$request->id)->first();
        // Storage::disk('public')->delete('product/'.$product->image_path);
        $product->delete();

        return redirect()->back();
    }
}