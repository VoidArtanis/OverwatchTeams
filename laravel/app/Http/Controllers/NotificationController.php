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
class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $token = Input::get('token');
        $userId = Input::get('userId');

        $user = User::find($userId);
        $user->notifToken = $token;
        $user->save();


    }


}