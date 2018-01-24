<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
use Auth;
use App\Models\User;
use App\Models\TagRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Data\HeroAvatars;
use App\Data\RankImage;
use Session;
class CommonController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function login(Request $request)
    {
        return view('join');
    }

    public function getStarted(Request $request)
    {
        return view('getstarted');
    }

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        Session::flush(); //clears out all the exisiting sessions
        return view('home');
    }


}