<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use BattleNetApi;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function redirectToProvider_BattleNet()
    {
        return redirect(BattleNetApi::authenticationURL()); // redirect to BattleNet login page
    }

    public function handleProviderCallback_BattleNet()
    {
        $social_type = "BattleNet";

        if (isset($_GET['code'])) {
            $code = $_GET['code'];

            $token = BattleNetApi::requestToken($code);

            $account = BattleNetApi::authenticatedUser($token);
            if(empty($account->battletag)) abort(500,"A valid battle tag was not received from blizzard!");
            $user = $this->findOrCreateUser($account);
            Auth::login($user, true);
            return redirect('/');
        } else
            return redirect('/')->withErrors('failed.');

    }

    public function findOrCreateUser($acc)
    {
        $authUser = User::where('battleTag', '=', $acc->battletag)->first();

        if ($authUser) {
            $authUser->joined=true;
            $authUser->save();
            return $authUser;
        }

        $user = new User;
        $user->battleTag = $acc->battletag;
        $user->webBattleTag = $this->replace_hashes($acc->battletag);
        $user->safeBattleTag = explode("#", $acc->battletag)[0] ;
        $user->joined=true;
        $url = 'http://52.74.159.213:4444/api/v3/u/' . urlencode($this->replace_hashes($acc->battletag)) .  "/blob";
        $json = json_decode(file_get_contents($url), true);
        $user->us = $json['us'];
        $user->eu = $json['eu'];
        $user->kr = $json['kr'];
        $arr =[];

        $arr = (array)$json['us']['heroes']['playtime']['competitive'];
        arsort($arr);
        $user->compHeroes = array_keys($arr);

        $arr = (array)$json['us']['heroes']['playtime']['quickplay'];
        arsort($arr);
        $user->qpHeroes = array_keys($arr);

        $user->save();
        return $user;

    }

    function replace_hashes($string) {
        $string = str_replace("#", "-", $string);
        return $string;
    }
}
