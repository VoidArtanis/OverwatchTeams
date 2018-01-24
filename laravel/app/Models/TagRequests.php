<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Auth;

class TagRequests extends Eloquent
{

    use Notifiable;

    use SoftDeletes;

    public function userInfo() {
        return $this->hasOne(User::class,'battleTag','sender' );
    }



    public static function makeRequest($sender, $target)
    {
        $req = TagRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();

        if ($req == null) {
            $tag_request = new TagRequests;
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
        $req = TagRequests::where('sender', '=', $user1)->where('target', '=', $user2)->where('status', '=', 'accepted')->first();
        if (!$req) {
            $req = TagRequests::where('sender', '=', $user2)->where('target', '=', $user1)->where('status', '=', 'accepted')->first();
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
        $req = TagRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();
        return $req;
    }

    public static function getRequestRecieved($sender, $target)
    {
        $req = TagRequests::where('target', '=', $sender)->where('sender', '=', $target)->first();
        return $req;
    }

    public static function acceptRequest($sender, $target)
    {
        $req = TagRequests::where('sender', '=', $sender)->where('target', '=', $target)->first();

        if ($req != null) {
            $req->status = 'accepted';
            $req->save();
        }
    }

    public static function hasRequests()
    {
        $user = Auth::user();
        $req = TagRequests::where('target', '=', $user['battleTag'])->where('status', '=', 'pending')->first();

        if ($req) {
            return true;
        } else {
            return false;
        }
    }


}
