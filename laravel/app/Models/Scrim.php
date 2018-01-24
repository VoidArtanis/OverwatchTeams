<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Auth;

class Scrim extends Eloquent
{

    use Notifiable;

    use SoftDeletes;

    public function senderTeamInfo()
    {
        return $this->hasOne(Team::class, '_id', 'senderTeam');
    }

    public function targetTeamInfo()
    {
        return $this->hasOne(Team::class, '_id', 'targetTeam');
    }


    public static function hasScrimRequests()
    {
        $reqs = Scrim::where('targetLeader','=',Auth::user()['battleTag'])->where('status','=','pending')->get();
            return (count($reqs)>0);

    }

}
