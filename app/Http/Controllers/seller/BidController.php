<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index($product_id)
    {
        $product = Product::find($product_id);
        $bids = Bid::where('product_id', $product_id)->get();
        return view('seller.bidding', [
            'bids' => $bids,
            'product' => $product
        ]);
    }

    public function accept(Request $request)
    {
        $request->validate([
            'bid_id' => ['required', 'integer']
        ]);

        try{
            $bid = Bid::find($request->bid);
            $bid->winner = true;
            $bid->save();
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
