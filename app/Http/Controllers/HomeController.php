<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\match;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
 /*   public function index()
    {
        return view('home');
    }
*/

    public function index()
    {
        $user = User::find(Auth::id());
        if($user->level == 1) {
            return redirect::to('admin/list-match');
        } else {
            return redirect::to('user/list-match');
        }   
    }

}
