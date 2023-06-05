<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        return view('seller.dashboard', [
            'products' => $products
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'bid_end' => ['required', 'date']
        ]);

        try{

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $product = new Product();
            $product->seller_id = Auth::id();
            $product->code = rand(90000, 99999);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->status = 1;
            $product->image = $imageName;
            $product->bid_end = $request->bid_end;
            $product->save();

            return redirect()->back()->with('success', 'Successfully added a product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'bid_end' => ['required', 'date']
        ]);

        try{
            $product = Product::find($request->product_id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->bid_end = $request->bid_end;
            $product->save();

            return redirect()->back()->with('success', 'Successfully updated product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update_image(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        try{
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $product = Product::find($request->product_id);
            $product->image = $imageName;
            $product->save();

            return redirect()->back()->with('success', 'Successfully updated product image');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        try{
            $product = Product::find($request->product_id);
            $product->status = 0;
            $product->save();

            return redirect()->back()->with('success', 'Successfully deleted product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
