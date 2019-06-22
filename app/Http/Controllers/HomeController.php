<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Laravel\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::check()) return redirect('/login');
        return view('home');
    }

    public function login(Request $request){

        if(Auth::check()) return redirect('/home');

        $userName = $request->input('userName');
        $passWord = $request->input('passWord');

        $data['first'] = true;

        if(isset($userName)){
            if(Auth::attempt(array('username' => $userName, 'password' => $passWord), true)){

              $request->session()->put('userID', User::getUserID($userName));
              $request->session()->put('userName', $userName);

              return redirect('/home');

            } else {
                $data['first'] = false;
                $data['username'] = $userName;
                return view('auth/login', $data);
            }
        } else {
                $data['username'] = '';
                return view('auth/login', $data);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
