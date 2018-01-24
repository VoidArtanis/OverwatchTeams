<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
use App\Helpers\DiscordHelper;
use App\Models\Scrim;
use App\Models\ScrimInvite;
use App\Models\TeamRequests;
use Auth;
use App\Models\User;
use App\Models\Team;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Data\HeroAvatars;
use App\Data\RankImage;

class ScrimController extends Controller
{
    public function registerindex(Request $request)
    {
        return \view('teams/register');
    }

    public function register(Request $request)
    {
        $country = Input::get('country');
        $teamname = Input::get('teamname');
        $btLeader = Input::get('btleader');
        $leaderEmail = Input::get('btleader-email');
        $btMember2 = Input::get('btmember2');
        $btMember3 = Input::get('btmember3');
        $btMember4 = Input::get('btmember4');
        $btMember5 = Input::get('btmember5');
        $btMember6 = Input::get('btmember6');
        $teambio = Input::get('teambio');
        $region = Input::get('region');
        $confirmation = uniqid();

        $req = Team::where('name', '=', $teamname)->first();

        User::fetchData(str_replace("#", "-", $btLeader));
        User::fetchData(str_replace("#", "-", $btMember2));
        User::fetchData(str_replace("#", "-", $btMember3));
        User::fetchData(str_replace("#", "-", $btMember4));
        User::fetchData(str_replace("#", "-", $btMember5));
        User::fetchData(str_replace("#", "-", $btMember6));

        if ($req != null) {
            return redirect()->back()->withInput()->withErrors(['A team with the same name exists! Please try a different name.']);
        }

        $team = new Team();
        $team->country = $country;
        $team->name = $teamname;
        $team->btleader = $btLeader;
        $team->leaderEmail = $leaderEmail;
        $team->btMember2 = $btMember2;
        $team->btMember3 = $btMember3;
        $team->btMember4 = $btMember4;
        $team->btMember5 = $btMember5;
        $team->btMember6 = $btMember6;
        $team->btMember6 = $btMember6;
        $team->bio = $teambio;
        $team->region = $region;

        $team->country = $country;
        $team->confirmation = $confirmation;
        $team->confirmed = false;
        $team->active = false;
        $team->save();


        Mail::send('emails.teamconfirm', ['title' => 'Team Registration Request', 'content' => 'Click the below link to confirm registration of your team: ' . $teamname, 'link' => 'https://overwatchteams.com/teams/confirm?id=' . $confirmation], function ($message) {
            $message->subject('Team Create Request');

            $message->from('info@overwatchteams.com', 'Overwatch Team Finder');

            $message->to(Input::get('btleader-email'));
        });


        return \view('teams/confirm');
    }

    public function confirm(Request $request)
    {
        $req = Team::where('confirmation', '=', Input::get('id'))->first();

        if ($req != null && !$req['confirmed']) {
            $req->confirmed = true;
            $req->save();
            TeamRequests::makeLeaderRequest($req, $req['btleader']);
            TeamRequests::makeRequest($req, $req['btMember2']);
            TeamRequests::makeRequest($req, $req['btMember3']);
            TeamRequests::makeRequest($req, $req['btMember4']);
            TeamRequests::makeRequest($req, $req['btMember5']);
            TeamRequests::makeRequest($req, $req['btMember6']);
            return view('teams/afterconfirm', ['teamName' => $req['name']]);
        } else {
            return App::abort(404);
        }
    }

    public function confirmUser()
    {
        $id = Input::get('id');
        $user = Auth::user();
        if ($user && $id) {
            $data = TeamRequests::where('target', '=', $user['battleTag'])->where('teamId', '=', $id)->where('status', '=', 'pending')->first();
            if ($data) {
                $data->status = 'accepted';
                $team = Team::find($id);
                $data->save();
                $team->active = Team::getActiveStatus($team);
                $team->save();
                Team::updateTeamSr($team); //has inner save
            }
        }
    }

    public function rejectUser()
    {
        $id = Input::get('id');
        $user = Auth::user();
        if ($user && $id) {
            $data = TeamRequests::where('target', '=', $user['battleTag'])->where('teamId', '=', $id)->where('status', '=', 'pending')->first();
            if ($data) {
                $data->status = 'rejected';
                $team = Team::find($id);
                $data->save();
                $team->active = Team::getActiveStatus($team);
                $team->save();
                Team::updateTeamSr($team); //has inner save
            }

        }
    }

    public function myteams()
    {
        $user = Auth::user();
        if ($user) {
            $data = TeamRequests::whereRaw(['target' => ['$eq' => $user['battleTag']], 'status' => ['$ne' => 'rejected']])->get();

            return \view('teams/myteams', ['data' => $data, 'rank_images' => RankImage::$data]);
        }
    }

    public function index(Request $request)
    {
        $scrim = null;
        if (Input::get('id')) {
            $scrim = Scrim::find(Input::get('id'));
            if($scrim){
                $scrimDate = str_replace('/', '-', $scrim['date']);
               if(strtotime($scrimDate) < strtotime('today UTC')){
                   $scrim->status='expired';
                   $scrim->save();
               }
            }
        }

        return \view('scrims/scrim', ['data' => $scrim, 'rank_images' => RankImage::$data]);


    }

    public function edit(Request $request)
    {
        $id = Input::get('id');
        if ($id) {

            $team = Team::find($id);
            $country = $team['country'];
            $teamName = $team['name'];
            $teamname = $team['teamname'];
            $btLeader = $team['btleader'];
            $leaderEmail = $team['leaderEmail'];
            $btMember2 = $team['btMember2'];
            $btMember3 = $team['btMember3'];
            $btMember4 = $team['btMember4'];
            $btMember5 = $team['btMember5'];
            $btMember6 = $team['btMember6'];
            $region = $team['region'];
            $teambio = $team['bio'];

            User::fetchData(str_replace("#", "-", $btLeader));
            User::fetchData(str_replace("#", "-", $btMember2));
            User::fetchData(str_replace("#", "-", $btMember3));
            User::fetchData(str_replace("#", "-", $btMember4));
            User::fetchData(str_replace("#", "-", $btMember5));
            User::fetchData(str_replace("#", "-", $btMember6));

            $vals = [
                'country' => $country,
                'teamname' => $teamname,
                'btleader' => $btLeader,
                'btleader-email' => $leaderEmail,
                'btmember2' => $btMember2,
                'btmember3' => $btMember3,
                'btmember4' => $btMember4,
                'btmember5' => $btMember5,
                'btmember6' => $btMember6,
                'teambio' => $teambio,
                'region' => $region,
                'teamname' => $teamName,
                'id' => $id
            ];

            return \view('teams/edit', ['oldval' => $vals]);
        }
    }

    public function editPost(Request $request)
    {

        $country = Input::get('country');
        $id = Input::get('id');
        $teamname = Input::get('teamname');
        $btLeader = Input::get('btleader');
        $leaderEmail = Input::get('btleader-email');
        $btMember2 = Input::get('btmember2');
        $btMember3 = Input::get('btmember3');
        $btMember4 = Input::get('btmember4');
        $btMember5 = Input::get('btmember5');
        $btMember6 = Input::get('btmember6');
        $teambio = Input::get('teambio');
        $region = Input::get('region');

        $req = Team::where('name', '=', $teamname)->first();

        if ($req != null) {
            if ($req['_id'] != $id)
                return redirect()->back()->withInput()->withErrors(['A team with the same name exists! Please try a different name.']);
        }

        $team = Team::find($id);
        $team->country = $country;
        $team->name = $teamname;
        $team->btleader = $btLeader;
        $team->leaderEmail = $leaderEmail;
        $team->btMember2 = $btMember2;
        $team->btMember3 = $btMember3;
        $team->btMember4 = $btMember4;
        $team->btMember5 = $btMember5;
        $team->btMember6 = $btMember6;
        $team->btMember6 = $btMember6;
        $team->bio = $teambio;
        $team->region = $region;

        $team->country = $country;

        $team->save();


        return \view('home');
    }

    public function delete(Request $request)
    {
        $id = Input::get('id');
        if ($id) {
            $team = Team::find($id);
            $team->delete();

            $reqs = TeamRequests::where('teamId', '=', $team['_id'])->get();
            foreach ($reqs as $r) {
                $r->delete();
            }
            return view('message', ['title' => 'Successful!', 'message' => 'The team: ' . $team['name'] . ' was Successfully deleted.', 'submessage' => '']);
        }
    }

    public function schedulePost(Request $request)
    {
        $invite = new Scrim();
        $targetTeam = Team::find(Input::get('targetTeam'));
        $senderTeam = Team::find(Input::get('senderTeam'));
        $targetLeader = $targetTeam['btleader'];
        $invite->targetTeam = Input::get('targetTeam');
        $invite->senderTeam = Input::get('senderTeam');
        $invite->time = Input::get('time');
        $invite->date = Input::get('date');
        $invite->customMessage = Input::get('customMessage');
        $invite->matches = Input::get('matches');
        $invite->status = 'pending';
        $invite->targetLeader = $targetLeader;
        $members = [
            $targetTeam['btleader'] ?: '',
            $targetTeam['btMember2'] ?: '',
            $targetTeam['btMember3'] ?: '',
            $targetTeam['btMember4'] ?: '',
            $targetTeam['btMember5'] ?: '',
            $targetTeam['btMember6'] ?: '',

            $senderTeam['btleader'] ?: '',
            $senderTeam['btMember2'] ?: '',
            $senderTeam['btMember3'] ?: '',
            $senderTeam['btMember4'] ?: '',
            $senderTeam['btMember5'] ?: '',
            $senderTeam['btMember6'] ?: '',
        ];
        $invite->members = $members;

        $invite->save();
        Mail::send('emails.teamconfirm', ['title' => 'Scrim Invitation', 'content' => 'Team  <strong>' . $senderTeam['name'] . '</strong>has sent an invitation', 'link' => 'https://overwatchteams.com/scrim?id=' . $invite['_id']], function ($message) {
            $message->subject('Scrim Invitation');
            $message->from('info@overwatchteams.com', 'Overwatch Team Finder');
            $targetTeam = Team::find(Input::get('targetTeam'));
            $message->to($targetTeam['leaderEmail']);
        });
        return view('scrims/scrim', ['data' => $invite]);
    }

    public function schedule(Request $request)
    {
        $teamId = Input::get('id');
        if ($teamId) {
            $opTeam = Team::find($teamId);
            if ($opTeam) {
                $user = Auth::user();
                $teams = Team::where('btleader', '=', $user['battleTag'])->get();
                return \view('scrims/schedule', ['myTeams' => $teams, 'opTeam' => $opTeam]);
            } else {
                abort(404, 'Team not found!');
            }
        } else {
            abort(404, 'Team not found!');
        }

    }

    public function scrimAccept(Request $request)
    {
        $scrimId = Input::get('id');
        if ($scrimId) {
           $scrim = Scrim::find($scrimId);
           if($scrim){
               $scrim->status='accepted';
               $channel = DiscordHelper::createChannelForScrim($scrim->senderTeamInfo->name);
               $channelId = $channel['id'];
               $channelInvite = DiscordHelper::createChannelInvite($channelId);
               $scrim->discordChannelId = $channelId;
               $scrim->discordChannelInviteCode = $channelInvite['code'];
               $scrim->save();
               return \redirect(route('teamscrim').'?id=' . $scrimId);
           }else
           {
               abort(404, 'Scrim Not Found!');
           }
        } else {
            abort(404, 'Scrim Id Not Found!');
        }
    }

}
