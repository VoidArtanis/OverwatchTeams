<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Psy\Exception\Exception;

class User extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    use Notifiable;

    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'battleTag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function fetchData($webTag)
    {
        $authUser = User::where('webBattleTag', '=', $webTag)->first();

        if ($authUser == null) {
            try {
                $tag = str_replace("-", "#", $webTag);
                $user = new User;
                $user->battleTag = $tag;
                $user->webBattleTag = $webTag;
                $user->safeBattleTag = explode("#", $tag)[0];
                $url = 'http://52.74.159.213:4444/api/v3/u/' . urlencode($webTag) . "/blob";

                $json = json_decode(file_get_contents($url), true);
            } catch (\Exception $e) {
                return abort(404, 'player-not-found');

            }

            $user->us = $json['us'];
            $user->eu = $json['eu'];
            $user->kr = $json['kr'];

            $arr = [];
            /*
             * US HEROES
             */
            if ($json['us']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['us']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->uscompHeroes = array_keys($arr);
            }

            if ($json['us']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['us']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->usqpHeroes = array_keys($arr);
            }

            /*
            * KR HEROES
            */
            if ($json['kr']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['kr']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->krcompHeroes = array_keys($arr);
            }

            if ($json['kr']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['kr']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->krqpHeroes = array_keys($arr);
            }

            /*
            * EU HEROES
            */
            if ($json['eu']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['kr']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->eucompHeroes = array_keys($arr);
            }

            if ($json['eu']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['kr']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->euqpHeroes = array_keys($arr);
            }

            $user->save();
            Team::updateTeamsSr($user['_id']);
        } else {
            $url = 'http://52.74.159.213:4444/api/v3/u/' . urlencode($webTag) . "/blob";
            $json = json_decode(file_get_contents($url), true);
            $authUser->us = $json['us'];
            $authUser->eu = $json['eu'];
            $authUser->kr = $json['kr'];
            $arr = [];
            /*
            * US HEROES
            */
            if ($json['us']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['us']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $authUser->uscompHeroes = array_keys($arr);
            }

            if ($json['us']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['us']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $authUser->usqpHeroes = array_keys($arr);
            }

            /*
            * KR HEROES
            */
            if ($json['kr']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['kr']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $authUser->krcompHeroes = array_keys($arr);
            }

            if ($json['kr']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['kr']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $authUser->krqpHeroes = array_keys($arr);
            }

            /*
            * EU HEROES
            */
            if ($json['eu']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['eu']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $authUser->eucompHeroes = array_keys($arr);
            }

            if ($json['eu']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['eu']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $authUser->euqpHeroes = array_keys($arr);
            }

            $authUser->save();
            Team::updateTeamsSr($authUser['_id']);
            return $authUser;
        }
        return $user;
    }

    public static function insertUser($webTag)
    {
        $authUser = User::where('webBattleTag', '=', $webTag)->first();

        if ($authUser == null) {
            $tag = str_replace("-", "#", $webTag);
            $user = new User;
            $user->battleTag = $tag;
            $user->webBattleTag = $webTag;
            $user->safeBattleTag = explode("#", $tag)[0];
            $url = 'http://52.74.159.213:4444/api/v3/u/' . urlencode($webTag) . "/blob";
            $json = json_decode(file_get_contents($url), true);
            $user->us = $json['us'];
            $user->eu = $json['eu'];
            $user->kr = $json['kr'];
            $arr = [];


            /*
             * US HEROES
             */
            if ($json['us']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['us']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->uscompHeroes = array_keys($arr);
            }

            if ($json['us']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['us']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->usqpHeroes = array_keys($arr);
            }

            /*
            * KR HEROES
            */
            if ($json['kr']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['kr']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->krcompHeroes = array_keys($arr);
            }

            if ($json['kr']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['kr']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->krqpHeroes = array_keys($arr);
            }

            /*
            * EU HEROES
            */
            if ($json['eu']['heroes']['playtime']['competitive']) {
                $arr = (array)$json['kr']['heroes']['playtime']['competitive'];
                $arr = array_filter($arr, function ($a) {
                    return $a > 0;
                });
                arsort($arr);
                $user->eucompHeroes = array_keys($arr);
            }

            if ($json['eu']['heroes']['playtime']['quickplay']) {
                $arr = (array)$json['kr']['heroes']['playtime']['quickplay'];
                $arr = array_filter($arr, function ($a) {
                    return $a >= 0;
                });
                arsort($arr);
                $user->euqpHeroes = array_keys($arr);
            }


            $user->save();
            Team::updateTeamsSr($user['_id']);
        }

    }

    public static function getFirstRegionAvailable($user)
    {
        if ($user['us']['stats']) return 'us';
        if ($user['kr']['stats']) return 'kr';
        if ($user['eu']['stats']) return 'eu';
    }

    public static function getRegionsAvailable($user)
    {
        $arr = [];
        if ($user['us']['stats']) array_push($arr, 'us');
        if ($user['kr']['stats']) array_push($arr, 'kr');
        if ($user['eu']['stats']) array_push($arr, 'eu');
        return $arr;
    }
}
