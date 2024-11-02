<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Balance;
use App\Models\Visitor;
use App\Models\Product;

class AdminDashController extends Controller
{
    public function index(){
        //Product Count
        $productCount = Product::count();
        //visitor Count
        $visitorCount = Visitor::count();

         // Set Stripe API key
         Stripe::setApiKey(env('STRIPE_SECRET')); // Make sure to put the secret key in the .env file.

         try {
             // Get available balance from Stripe
             $balance = Balance::retrieve();
 
            // Extract available and pending amounts
             $available = [];
             foreach ($balance->available as $item) {
                 $available[] = [
                     'amount' => $item->amount / 100,
                     'currency' => strtoupper($item->currency),
                 ];
             }
 
             $pending = [];
             foreach ($balance->pending as $item) {
                 $pending[] = [
                     'amount' => $item->amount / 100,
                     'currency' => strtoupper($item->currency),
                 ];
             }
 
             // Return balance to display
             return view('admin.dashboard.index', compact('available', 'pending','visitorCount','productCount'));
 
         } catch (\Exception $e) {
             return back()->withErrors(['error' => 'An error occurred while fetching the balance.: ' . $e->getMessage()]);
         }
    }
}
