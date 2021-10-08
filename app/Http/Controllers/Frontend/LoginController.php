<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function store(Request $request)
   {
      $request->validate([
         'email' => 'required|email',
         'password' => 'required',
         //'device_name' => 'required',
      ]);
      $user = User::where('email', $request->email)->first();
      if (!$user || !Hash::check($request->password, $user->password)) {
         return response('Login invalid', 503);
      }
      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
        //   $nm = $user->createToken('snipperToken');
        //   $tokenId = $nm->accessToken->id;
        //   $token = $nm->plainTextToken;        
        if($user->public_link == null){
            $public_link = \Illuminate\Support\Str::random(12);
            $user->public_link = $public_link;
            $user->save();
        }
        if($request->redirect_url!=null){
            return redirect($request->redirect_url);
            }  
          return Redirect::route('home.index');//->withFlash(['tokenId'=>$tokenId,'token'=>$token]);
      }
      return redirect('login');
   }
//    public function showLoginForm()
//     {
//         return Inertia::render('Auth/LoginPage');
//     }
    public function logout(Request $request)
    {
       // $tokenId = $request->tokenId;
       // \Log::info(' LOGIN '.$request->tokenId);
        $user = User::find(\Auth::user()->id);
       // $user->tokens()->where('id', $tokenId)->delete();
        $destination = \Auth::logout();
        return redirect('login');
    }
}
