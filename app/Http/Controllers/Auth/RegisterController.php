<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.regestier');
    }
    public function create(Request $request)
    {
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
            'role' => 'required|string|in:user,admin',
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
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();
        // Send Massage To Email
        Mail::send('emails.verify', ['token' => $token,'email' => $request->email , 'date' => $currentDate,'time'=>$currentTime], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Virfy Email');
        });

        return redirect()->route('register.page')->with('success', 'Congratulations, the account has been created. Please confirm the account. A message has been sent to your email.');

    }
    //verfiy Email
    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('register.page')->with('error', 'Invalid verification link.');
        }

        $user->email_verified = true;
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Account activated successfully!.');

    }
    public function confirm_email(Request $request){
    // Get the currently registered user
    $user = Auth::user();
    
   // Generate a random token
    $token = Str::random(60);
    
  // Update the email_verification_token field in the database
    $user->update([
        'email_verification_token' => $token
    ]);
    
    $currentDate = Carbon::now()->toDateString();
    $currentTime = Carbon::now()->toTimeString();
    // Send Massage To Email
    Mail::send('emails.confirm', ['token' => $token,'email' => $request->email , 'date' => $currentDate,'time'=>$currentTime], function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Virfy Email');
    });
    return redirect()->route('admin.prolile')->with('success', 'Congratulations, the confirmation message has been sent. Please confirm the account.');
    }
    public function verify_emails($token){
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('admin.prolile')->with('error', 'Invalid verification link.');
        }

        $user->email_verified = true;
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('admin.prolile')->with('success', 'Account activated successfully!.');

    }
}
