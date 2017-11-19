<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Builder;

use Carbon\Carbon;

use Auth;

use App\Licence;
use App\Courtier;
use App\Token;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {          
        return view('welcome');
    }
}
