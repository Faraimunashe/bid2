<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Auth;
use Exception;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::where('user_id', Auth::id())->get();
        return view('user.bidding', [
            'bids' => $bids
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'bid_id' => ['required', 'numeric']
        ]);

        try{
            $bid = Bid::find($request->bid_id);
            $bid->delete();

            return redirect()->back()->with('success', 'successfully deleted bid');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
