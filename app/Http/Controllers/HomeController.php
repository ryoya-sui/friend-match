<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = User::query();
        $key = $request->key;
        
        if (!empty($key)) {
            $query->where('category', 'like', '%' . $key . '%')->orWhere('self_introduction', 'like', '%' . $key . '%');
        }

        $users = $query->where('id', '!=', Auth::id())->get();
        $userCount = $users->count(); 
        $from_user_id = Auth::id();
        return view('home', compact('users', 'userCount', 'from_user_id'));
    }
}
