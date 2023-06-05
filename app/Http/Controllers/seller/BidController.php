<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Exception;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index($bid_id)
    {
        return view('seller.bidding');
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
