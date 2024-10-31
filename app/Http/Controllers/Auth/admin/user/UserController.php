<?php

namespace App\Http\Controllers\Auth\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function profile(){
        return view('admin.user.profile');
    }
}
