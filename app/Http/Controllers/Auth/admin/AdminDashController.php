<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Balance;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminDashController extends Controller
{
    public function index(){
        //Product Count
        $productCount = Product::count();
        //visitor Count
        $visitorCount = Visitor::count();
        $visitors = Visitor::all();

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
             return view('admin.dashboard.index', compact('available', 'pending','visitorCount','productCount','visitors'));
 
         } catch (\Exception $e) {
             return back()->withErrors(['error' => 'An error occurred while fetching the balance.: ' . $e->getMessage()]);
         }
    }
    public function adminsget(){
        $admins = User::where('role', 'admin')->get();
        return view('admin.dashboard.admins', compact('admins'));
    }
    public function admincreate(){
        return view('admin.dashboard.create');
    }
    public function storeadmin(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'required|date',
            'job' => 'nullable|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'zip_code' => 'required|string',
            'phone_number' => 'required|string',
            'role' => 'required|string|in:admin',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $token = Str::random(60);

        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'job' => $request->job,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone_number,
            'role' => $request->role, 
            'email_verified' => false,
            'email_verification_token' => $token,
            
        ]);
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $profileImagePath;
            $user->save(); 
        }
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();
        // Send Massage To Email
        Mail::send('emails.verify', ['token' => $token,'email' => $request->email , 'date' => $currentDate,'time'=>$currentTime], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Virfy Email');
        });

        return redirect()->route('admin.admins')->with('success', 'Congratulations, the account has been created. Please confirm the account. A message has been sent to your email.');


    }
    
    public function usersget(){
        $users = User::where('role', 'user')->get();
        return view('admin.dashboard.user.index', compact('users'));
    }
    public function userscreate(){
        return view('admin.dashboard.user.create');
    }
    public function storeuser(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'required|date',
            'job' => 'nullable|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'zip_code' => 'required|string',
            'phone_number' => 'required|string',
            'role' => 'required|string|in:user',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $token = Str::random(60);

        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'job' => $request->job,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone_number,
            'role' => $request->role, 
            'email_verified' => false,
            'email_verification_token' => $token,
            
        ]);
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $profileImagePath;
            $user->save(); 
        }
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();
        // Send Massage To Email
        Mail::send('emails.verify', ['token' => $token,'email' => $request->email , 'date' => $currentDate,'time'=>$currentTime], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Virfy Email');
        });

        return redirect()->route('admin.users')->with('success', 'Congratulations, the account has been created. Please confirm the account. A message has been sent to your email.');


    }
    public function usershow($id)
    {
        $user = User::findOrFail($id);
        return view('admin.dashboard.user.show', compact('user'));
    }

    public function userdestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
