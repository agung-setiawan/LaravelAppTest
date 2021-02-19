<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

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
    public function index()
    {
        $user = User::leftJoin('member', 'member.user_id', '=', 'users.id')
                    ->get()
                    ->toArray();

        return view('home')->with('users', $user);
    }
}
