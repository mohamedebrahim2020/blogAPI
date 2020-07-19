<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerUserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

  public $successStatus = 200;
  /** 
   * login api 
   * 
   * @return \Illuminate\Http\Response 
   */
  public function login()
  {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')->accessToken;
      return response()->json(['success' => $success], $this->successStatus);
    } else {
      return response()->json(['error' => 'Unauthorised'], 401);
    }
  }
  /** 
   * * Register api 
   * 
   * @return \Illuminate\Http\Response 
   */
  public function register(registerUserRequest $request)
  {



    if ($request->hasFile('image')) {
      $user = User::create([
        'first_name' => $request->first_name,
        'second_name' => $request->second_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'image' =>  $request->file('image')->store('files', 'public'),
      ]);
    } else {
      $user = User::create([
        'first_name' => $request->first_name,
        'second_name' => $request->second_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'image' =>  null,
      ]);
    }

    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['first_name'] =  $user->first_name;
    return response()->json(['success' => $success], $this->successStatus);
  }
}
