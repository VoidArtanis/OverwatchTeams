<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
use App\Models\Scrim;
use App\Models\TeamRequests;
use Auth;
use App\Models\User;
use App\Models\TagRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Data\HeroAvatars;
use App\Data\RankImage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $myProfile = false;
        $user = null;

        if (Auth::check()) {
            $loggedUser = Auth::user();
        }

        if (Input::get('id')) {
            $user = User::find(Input::get('id'));
            $user = User::fetchData($user['webBattleTag']);
            if (Auth::check()) {
                $myProfile = $loggedUser['webBattleTag'] == $user['webBattleTag'];
            }
        } else if (Input::get('tag')) {
            $ptag = Input::get('tag');
            if (strpos($ptag, '#') !== false) {
                $ptag = str_replace("#", "-", $ptag);
            }
            $user = User::fetchData($ptag);
            if (Auth::check()) {
                $myProfile = $loggedUser['webBattleTag'] == $user['webBattleTag'];
            }
        } else if (Auth::check()) {
            $user = Auth::user();
            $user = User::fetchData($user['webBattleTag']);
            $myProfile = true;
        } else {
            return view('home');
        }


        $region = Input::get('region');
        $cRegion = Input::get('region');
        if ($region && ($region == 'us' || $region == 'kr' || $region == 'eu')) {
            if ($user[$cRegion]['stats']) {
                $cRegion = $region;
            } else {
                $cRegion = User::getFirstRegionAvailable($user);
            }
        } else {
            $cRegion = User::getFirstRegionAvailable($user);
        }

        $main_hero = null;

        if (count($user[$cRegion . 'compHeroes']))
            if ($user[$cRegion . 'compHeroes'][0]) {
                $main_hero = $user[$cRegion . 'compHeroes'][0];
            } else {
                $main_hero = $user[$cRegion . 'qpHeroes'][0];
            }
        else
            if (count($user[$cRegion . 'qpHeroes'])) {
                $main_hero = $user[$cRegion . 'qpHeroes'][0];
            }

        $loggedUser = null;
        if (!Auth::guest() && !$myProfile) {

            $loggedUser = Auth::user();

            //if its accepted no need to calculate buttons
            if (TagRequests::isAccepted($loggedUser['battleTag'], $user['battleTag'])) {
                return view('profile', [
                    'user' => $user,
                    'hero_avatars' => HeroAvatars::$data,
                    'hero_names' => HeroNames::$data,
                    'rank_image' => RankImage::$data[$user[$cRegion]['stats']['competitive']['overall_stats']['tier']],
                    'hero_keys' => HeroKeys::$data,
                    'main_hero' => $main_hero,
                    'guest' => false,
                    'accepted' => true,
                    'cRegion' => $cRegion,
                    'regions' => User::getRegionsAvailable($user)
                ]);
            }

            $requestSent = TagRequests::getRequestSent($loggedUser['battleTag'], $user['battleTag']);
            $requestRecieved = TagRequests::getRequestRecieved($loggedUser['battleTag'], $user['battleTag']);
            return view('profile', [
                'user' => $user,
                'hero_avatars' => HeroAvatars::$data,
                'hero_names' => HeroNames::$data,
                'rank_image' => RankImage::$data[$user[$cRegion]['stats']['competitive']['overall_stats']['tier']],
                'hero_keys' => HeroKeys::$data,
                'main_hero' => $main_hero,
                'guest' => false,
                'request_sent' => $requestSent,
                'request_btn_text' => $requestSent ? 'Request Sent' : 'Request BattleTag',
                'requestRecieved' => $requestRecieved,
                'accepted' => false,
                'cRegion' => $cRegion,
                'regions' => User::getRegionsAvailable($user)
            ]);
        } else {
            return view('profile', [
                'user' => $user,
                'hero_avatars' => HeroAvatars::$data,
                'hero_names' => HeroNames::$data,
                'rank_image' => RankImage::$data[$user[$cRegion]['stats']['competitive']['overall_stats']['tier']],
                'hero_keys' => HeroKeys::$data,
                'main_hero' => $main_hero,
                'guest' => true,
                'accepted' => false,
                'cRegion' => $cRegion,
                'regions' => User::getRegionsAvailable($user)
            ]);
        }

    }

    public function profileRequest(Request $request)
    {
        if (!Auth::guest()) {
            if (Input::get('target')) {
                $id = Input::get('target');
                $target = User::find($id);
                $loggedUser = Auth::user();
                if ($target && $loggedUser) {
                    TagRequests::makeRequest($loggedUser['battleTag'], $target['battleTag']);

                    if ($target['notifToken']) {
                        $notif = ["notification" => [
                            "title" => "New BattleTag Request",
                            "body" => "You have new battle tag requests!",
                            "icon" => "https://overwatchteams.com/img/icon.png",
                            "click_action" => "https://overwatchteams.com/requests"
                        ], "to" => $target['notifToken']];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notif));  //Post Fields
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $headers = [
                            'Authorization: key=AAAA0WEW-CY:APA91bGvopMQZIo5qBTl4_fIcnGM2xeZLacjvtUPJhLvBiYXNlA5dV-PsuA1tJWdZ7XENoAm7dU0p3sYZxk6jjMYxPKdjs7awZoTIVK_7SdvYLcYWNUA3C4sYIQcPbwvTUFWdSGcPdP6',
                            'Host: fcm.googleapis.com',
                            'Content-Type: application/json',
                            'Cache-Control: no-cache',

                        ];

                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $server_output = curl_exec($ch);

                        curl_close($ch);

                        print  $server_output;
                    }
                }
                return redirect('profile?id=' . $id);
            }
        }

    }

    public function profileAccept(Request $request)
    {
        if (!Auth::guest()) {
            if (Input::get('sender')) {
                $id = Input::get('sender');
                $sender = User::find($id);
                $loggedUser = Auth::user();
                if ($sender && $loggedUser) {

                    TagRequests::acceptRequest($sender['battleTag'], $loggedUser['battleTag']);
                }
                return redirect('profile?id=' . $id);
            }
        }

    }

    public function showRequests()
    {
        $requests = TagRequests::where('target', Auth::user()['battleTag'])->where('status', 'pending')->paginate(7);
        $teamRequests = TeamRequests::where('target', Auth::user()['battleTag'])->where('status', 'pending')->get();
        $scrimRequests = Scrim::where('targetLeader','=',Auth::user()['battleTag'])->where('status','=','pending')->get();
        return view('requests', [
            'data' => $requests,
            'rank_images' => RankImage::$data,
            'teamRequests' => $teamRequests,
            'scrimRequests' => $scrimRequests,
        ]);
    }

    public function getMatches()
    {
        $teamRequests = TeamRequests::where('target', Auth::user()['battleTag'])->where('status', 'active')->get();
        $scrims = [];

        foreach ($teamRequests as $tr) {
            $ts = Scrim::where('targetTeam','=',$tr['teamid'])->orWhere('senderTeam','=',$tr['teamid']);
            foreach ($ts as $t){
                array_push($scrims, $t);
            }
        }

        return view('matches', [
            'data' => $scrims,
            'rank_images' => RankImage::$data,
        ]);
    }

    public function registerFill(Request $request)
    {

        $user = Auth::user();
        $user->regfillshowed = true;
        $user->save();
        return view('registerFill');
    }

    public function editProfile(Request $request)
    {

        $user = Auth::user();
        $user->regfillshowed = true;
        $country = 'US';
        if ($user['country']) {
            $country = $user['country'];
        }
        $user->save();
        return view('editRegisterFill', ['country' => $country]);
    }

    public function regFillPost(Request $request)
    {
        $country = Input::get('country');
        if ($country) {
            $user = Auth::user();
            $user->regfillshowed = true;
            $user->country = $country;
            $user->save();
        }
        return redirect('');
    }

    public function editProfilePost(Request $request)
    {
        $country = Input::get('country');
        if ($country) {
            $user = Auth::user();
            $user->regfillshowed = true;
            $user->country = $country;
            $user->save();
        }
        return redirect('');
    }

    public function regfillSkip()
    {
        $user = Auth::user();
        $user->regfillshowed = true;
        $user->save();
        return view('registerFill');
    }


}
