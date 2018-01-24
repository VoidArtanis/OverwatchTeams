<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Auth;

class Team extends Eloquent
{

    use Notifiable;

    use SoftDeletes;


    public function member2Info()
    {
        return $this->hasOne(User::class, 'battleTag', 'btMember2');
    }

    public function member3Info()
    {
        return $this->hasOne(User::class, 'battleTag', 'btMember3');
    }

    public function member4Info()
    {
        return $this->hasOne(User::class, 'battleTag', 'btMember4');
    }

    public function member5Info()
    {
        return $this->hasOne(User::class, 'battleTag', 'btMember5');
    }

    public function member6Info()
    {
        return $this->hasOne(User::class, 'battleTag', 'btMember6');
    }

    public function leaderInfo()
    {
        return $this->hasOne(User::class, 'battleTag', 'btleader');
    }

    public static function getTeamSr($team)
    {
        $sr1 = $team->leaderInfo['us']['stats']['competitive']['overall_stats']['comprank'];
        $sr2 = $team->member2Info['us']['stats']['competitive']['overall_stats']['comprank'];
        $sr3 = $team->member3Info['us']['stats']['competitive']['overall_stats']['comprank'];
        $sr4 = $team->member4Info['us']['stats']['competitive']['overall_stats']['comprank'];
        $sr5 = $team->member5Info['us']['stats']['competitive']['overall_stats']['comprank'];
        $sr6 = $team->member6Info['us']['stats']['competitive']['overall_stats']['comprank'];

        if ($sr1 && $sr2 && $sr3 && $sr4 && $sr5 && $sr6) {
            return ceil(($sr1 + $sr2 + $sr3 + $sr4 + $sr5 + $sr6) / 6.0);
        } else {
            return -1;
        }
    }

    public static function updateTeamsSr($userId)
    {
        if (!$userId) return;
        $user = User::find($userId);
        if ($user) {
            $teams = TeamRequests::where('target', '=', $user['battleTag'])->where('status', '=', 'accepted')->get();
            foreach ($teams as $temp) {
                $id = $temp['teamId'];
                $team = Team::find($id);
                $team->sr = Team::getTeamSr($team);
                $team->tier = Team::rankFromSr($team->sr);
                $team->save();
            }
        }
    }

    public static function updateTeamSr($teamOld)
    {
        if (!$teamOld) return;
        if ($teamOld) {
            $team = Team::find($teamOld['_id']);
            $team->sr = Team::getTeamSr($team);
            $team->tier = Team::rankFromSr($team->sr);
            $team->save();
        }
    }

    public static function getActiveStatus($team)
    {
        $data = TeamRequests::where('target', '=', $team['btMember2'])->where('teamId', '=', $team['_id'])->where('status', '=', 'accepted')->first();
        if (empty($data)) {
            return false;
        }
        $data = TeamRequests::where('target', '=', $team['btMember3'])->where('teamId', '=', $team['_id'])->where('status', '=', 'accepted')->first();
        if (empty($data)) {
            return false;
        }
        $data = TeamRequests::where('target', '=', $team['btMember4'])->where('teamId', '=', $team['_id'])->where('status', '=', 'accepted')->first();
        if (empty($data)) {
            return false;
        }
        $data = TeamRequests::where('target', '=', $team['btMember5'])->where('teamId', '=', $team['_id'])->where('status', '=', 'accepted')->first();
        if (empty($data)) {
            return false;
        }
        $data = TeamRequests::where('target', '=', $team['btMember6'])->where('teamId', '=', $team['_id'])->where('status', '=', 'accepted')->first();
        if (empty($data)) {
            return false;
        }

        return true;
    }

    public static function rankFromSr($sr)
    {
        if ($sr <= 1500) {
            return 'bronze';
        } elseif ($sr <= 2000 && $sr > 1500) {
            return 'silver';
        } elseif ($sr <= 2500 && $sr > 2000) {
            return 'gold';
        } elseif ($sr <= 3000 && $sr > 2500) {
            return 'platinum';
        } elseif ($sr <= 3500 && $sr > 3000) {
            return 'diamond';
        } elseif ($sr <= 4000 && $sr > 3500) {
            return 'master';
        } elseif ($sr >= 4500) {
            return 'grandmaster';
        }
    }

    public static function makeRequest($sender, $target)
    {
        $req = TeamRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();

        if ($req == null) {
            $tag_request = new TeamRequests;
            $tag_request->sender = $sender;
            $tag_request->target = $target;
            $tag_request->status = 'pending';
            $tag_request->save();
            return $tag_request;
        } else {
            return $req;
        }

    }

    public static function isAccepted($user1, $user2)
    {
        $req = TeamRequests::where('sender', '=', $user1)->where('target', '=', $user2)->where('status', '=', 'accepted')->first();
        if (!$req) {
            $req = TeamRequests::where('sender', '=', $user2)->where('target', '=', $user1)->where('status', '=', 'accepted')->first();
            if ($req) {
                return true;
            }
        } else {
            return true;
        }

        return false;
    }

    public static function getRequestSent($sender, $target)
    {
        $req = TeamRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();
        return $req;
    }

    public static function getRequestRecieved($sender, $target)
    {
        $req = TeamRequests::where('target', '=', $sender)->where('sender', '=', $target)->first();
        return $req;
    }

    public static function acceptRequest($sender, $target)
    {
        $req = TeamRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();

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
