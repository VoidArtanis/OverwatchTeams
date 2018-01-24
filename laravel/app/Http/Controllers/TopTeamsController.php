<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
use App\Data\Ranks;
use App\Models\Team;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Data\HeroAvatars;
use App\Data\RankImage;

class TopTeamsController extends Controller
{
    public function index(Request $request)
    {

        $users = null;

        $tier = 'all';
        if (Input::get('tier')) {
            $tier = Input::get('tier');
        }


        $page = 0;

        $counter=0;

        if (Input::get('page')) {
            $page = Input::get('page')-1;
            $counter = $page * 50;
        }
        $country = Input::get('country');


        $global = Input::get('global');
        $local = false;
        $data=null;

        if($country && !($global && $global == 'on')){
           $data = Team::where('country','=',$country)->where('active', '=', true)->orderBy('sr',-1)->get();
            $local=true;
        }else{
            $data = Team::where('active', '=', true)->orderBy('sr',-1)->get();
        }

        if(empty($country)){
            $country='US';
        }

//        if ($hero == 'all') {
//            if ($tier == 'all')
//                $users = DB::collection('users')->orderBy($sortQuery, -1)->paginate(50);
//            else
//                $users = DB::collection('users')->whereRaw(['us.stats.competitive.overall_stats.tier' => ['$eq' => $tier]])->orderBy($sortQuery, -1)->paginate(50);
//
//        } else {
//            if ($tier == 'all')
//            $users = DB::collection('users')->whereRaw(['compHeroes.0' => ['$eq' => $hero]])->orderBy($sortQuery, -1)->paginate(50);
//            else
//                $users = DB::collection('users')->whereRaw(['compHeroes.0' => ['$eq' => $hero],'us.stats.competitive.overall_stats.tier' => ['$eq' => $tier]])->orderBy($sortQuery, -1)->paginate(50);
//        }



        return view('teams/topteams', [
            'data' => $data ,

            'rank_images' => RankImage::$data,

            'tier' => $tier,
            'page' => $page,
            'countryFilter' =>$country,
            'counter' => $counter,
            'ranks' => Ranks::$data,
            'ranks' => Ranks::$data,
            'local' => $local
        ]);
    }


}