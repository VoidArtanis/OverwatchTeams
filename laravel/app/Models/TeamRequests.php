<?php

namespace App\Models;

use App\Http\Utils;
use Illuminate\Notifications\Notifiable;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Auth;

class TeamRequests extends Eloquent
{

    use Notifiable;

    use SoftDeletes;

    public function teamInfo()
    {
        return $this->hasOne(Team::class, '_id', 'teamId');
    }

    public static function makeRequest($team, $target)
    {
        $req = TeamRequests::where('team', '=', $team['name'])->where('target', '=', $target)->first();
        $user = User::where('battleTag', '=', $target);
        if ($user) {
            if ($req == null) {
                $tag_request = new TeamRequests;
                $tag_request->team = $team['name'];
                $tag_request->teamId = $team['_id'];
                $tag_request->target = $target;
                $tag_request->status = 'pending';
                $tag_request->save();

                return $tag_request;
            } else {
                return $req;
            }
            if ($user['notifToken'])
                Utils::curlNotifHelper($user['notifToken'], 'New Team Request', 'Team: ' . $team, 'https://overwatchteams.com/requests');
        }
    }
    public static function makeLeaderRequest($team, $target)
    {
        $req = TeamRequests::where('team', '=', $team['name'])->where('target', '=', $target)->first();
        $user = User::where('battleTag', '=', $target);
        if ($user) {
            if ($req == null) {
                $tag_request = new TeamRequests;
                $tag_request->team = $team['name'];
                $tag_request->teamId = $team['_id'];
                $tag_request->target = $target;
                $tag_request->status = 'accepted';
                $tag_request->save();

                return $tag_request;
            } else {
                return $req;
            }
            if ($user['notifToken'])
                Utils::curlNotifHelper($user['notifToken'], 'New Team Request', 'Team: ' . $team, 'https://overwatchteams.com/requests');
        }
    }
    public static function isAccepted($user1, $user2)
    {
        $req = TeamRequests::where('team', '=', $user1)->where('target', '=', $user2)->where('status', '=', 'accepted')->first();
        if (!$req) {
            $req = TeamRequests::where('team', '=', $user2)->where('target', '=', $user1)->where('status', '=', 'accepted')->first();
            if ($req) {
                return true;
            }
        } else {
            return true;
        }
        return false;
    }

    public static function getRequestSent($team, $target)
    {
        $req = TeamRequests::where('team', '=', $team)->where('target', '=', $target)->first();
        return $req;
    }

    public static function getRequestRecieved($team, $target)
    {
        $req = TeamRequests::where('target', '=', $team)->where('team', '=', $target)->first();
        return $req;
    }

    public static function acceptRequest($team, $target)
    {
        $req = TeamRequests::where('team', '=', $team)->where('target', '=', $target)->first();

        if ($req != null) {
            $req->status = 'accepted';
            $req->save();
        }
    }


    public static function hasRequests()
    {
        $user = Auth::user();
        $req = TeamRequests::where('target', '=', $user['battleTag'])->where('status', '=', 'pending')->first();

        if ($req) {
            return true;
        } else {
            return false;
        }
    }


}
