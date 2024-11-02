<?php

namespace App\Http\Controllers\Auth\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
    }
    public function profile(){
        return view('admin.user.profile');
    }
    public function edit(){
        $user = Auth::user();
        return view('admin.user.edit',compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'birth_date' => 'required|date',
            'job' => 'nullable|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'zip_code' => 'required|string',
            'phone_number' => 'required|string',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->birth_date = $request->birth_date;
        $user->job = $request->job;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->zip_code = $request->zip_code;
        $user->phone_number = $request->phone_number;
        $oldemail=Auth::user()->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        //check image for update
        
        if ($request->hasFile('profile_image')) { 
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            $user->profile_image = $request->file('profile_image')->store('profiles', 'public'); // حفظ الصورة الجديدة
        }
        
            // Check email change
   
    if ($request->email !== $user->email) {
            $user->email = $request->email;
            $token = Str::random(60);
            $user->email_verification_token = $token;
            $user->email_verified = 0;
            $currentDate = Carbon::now()->toDateString();
            $currentTime = Carbon::now()->toTimeString();
            // Send Massage To Email
            Mail::send('emails.confirm', ['token' => $token,'email' => $request->email , 'date' => $currentDate,'time'=>$currentTime], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Virfy Email');
            });
        }else{
            $user->email = $request->email;
        }

        $user->save();

        return redirect()->route('user.edit')->with('success', 'User information updated successfully..');
    }
}
