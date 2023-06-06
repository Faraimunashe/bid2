<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Product;
use Auth;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        return view('user.dashboard', [
            'products' => $products
        ]);
    }

    public function bid(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);

        $product = Product::find($request->product_id);
        if(is_null($product))
        {
            return redirect()->back()->with('error', 'Product not found');
        }

        if($request->amount < $product->price)
        {
            return redirect()->back()->with('error', 'Amount less than product price');
        }

        try{

            $exist = Bid::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
            if(is_null($exist))
            {

                $bid = new Bid();
                $bid->user_id =Auth::id();
                $bid->product_id = $request->product_id;
                $bid->amount = $request->amount;
                $bid->winner = false;
                $bid->save();

            }else
            {
                if($exist->winner)
                {
                    return redirect()->back()->with('error', 'The bid was closed by the seller');
                }
                $biggest = Bid::where('product_id',$request->product_id)->orderBy('amount', 'desc')->first();
                if($request->amount < $biggest->amount)
                {
                    return redirect()->back()->with('error', 'Your bid is less than the biggest bid');
                }

                $exist->amount = $request->amount;
                $exist->save();

                return redirect()->back()->with('success', 'success placed a bid');
            }


        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
