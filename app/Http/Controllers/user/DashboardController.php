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
        return view('user.dashboard');
    }

    public function bid(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);

        try{
            $exist = Bid::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
            if(is_null($exist))
            {
                $bid = new Bid();
                $bid->user_id =Auth::id();
                $bid->product_id = $request->product_id;
                $bid->amount = $request->amount;
                $bid->winner = true;
                $bid->save();

            }else {

                $exist->amount = $request->amount;
                $exist->save();
            }

            return redirect()->back()->with('success', 'success placed a bid');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
