<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function showRegisterForm() {
        return view('auth.registerform');
    }

    public function store(Request $request) {
        $validate = $this->validate($request,$this->validation);
        
        if(!$validate) {
            Session::flash('error', 'Fill all field');
        }
        
        $userSave = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role'  => 'user',
        ]);
        
        

    }
}
