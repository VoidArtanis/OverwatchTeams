<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
use App\Data\Ranks;
use App\Data\Regions;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Data\HeroAvatars;
use App\Data\RankImage;

class TopPlayersController extends Controller
{
    public function index(Request $request)
    {
        $inRange = false;
        if (Input::get('inrange')) {
            $inRange = true;
        }

        $users = null;
        $hero = 'all';

        if (Input::get('hero')) {
            $hero = Input::get('hero');
        }


        $tier = 'all';
        if (Input::get('tier')) {
            $tier = Input::get('tier');
        }


        $page = 0;
        $counter = 0;

        if (Input::get('page')) {
            $page = Input::get('page') - 1;
            $counter = $page * 50;
        }

        $region = Input::get('region');
        $cRegion = Input::get('region');
        if ($region && ($region == 'us' || $region == 'kr' || $region == 'eu')) {
            $cRegion = $region;
        } else {
            $cRegion = 'us';
        }
        $sortQuery = $cRegion . '.stats.competitive.overall_stats.comprank';


        $country = Input::get('country');

        if (empty($country)) {
            $country = 'all';
        }

//        if (Input::get('sort')) {
//            $sortBy = Input::get('sort');
//            switch ($sortBy) {
//                case 'time-desc':
//                    $sort = -1;
//                    $sortQuery='us.heroes.playtime.competitive.' . $hero;
//                    break;
//                case 'time-asc':
//                    $sort = 1;
//                    $sortQuery='us.heroes.playtime.competitive.' . $hero;
//                    break;
//                case 'games-desc':
//                    $sort = -1;
//                    $sortQuery='us.heroes.stats.competitive.' . $hero . '.average_stats.games_played';
//                    break;
//                case 'games-asc':
//                    $sort = 1;
//                    $sortQuery='us.heroes.stats.competitive.' . $hero . '.average_stats.games_played';
//                    break;
//                case 'sr-desc':
//                    $sort = -1;
//                    $sortQuery='us.stats.competitive.overall_stats.comprank';
//                    break;
//                case 'sr-asc':
//                    $sort = 1;
//                    $sortQuery='us.stats.competitive.overall_stats.comprank';
//                    break;
//            }
//        }

        $query = [];
        if($country != 'all'){
            $query['country' ]= ['$eq' => $country];
        }
        if ($tier != 'all'){
            $query[$cRegion . '.stats.competitive.overall_stats.tier'] = ['$eq' => $tier];
        }
        if ($hero != 'all'){
            $query[$cRegion . 'compHeroes.0'] = ['$eq' => $hero];
        }

        if(count($query) > 0){
            $users = DB::collection('users')->whereRaw($query)->orderBy($sortQuery, -1)->paginate(50)->appends(Input::except('page'));
        }else{
            $users = DB::collection('users')->orderBy($sortQuery, -1)->paginate(50)->appends(Input::except('page'));
        }


        $main_hero = null;
        $sortedHeroes = HeroNames::$data;
        ksort($sortedHeroes);

        return view('topplayers', [
            'users' => $users,
            'heroes' => $sortedHeroes,
            'rank_images' => RankImage::$data,
            'hero' => $hero,
            'tier' => $tier,
            'page' => $page,
            'counter' => $counter,
            'ranks' => Ranks::$data,
            'cRegion' => $cRegion,
            'regions' => Regions::$data,
            'country' => $country
        ]);
    }


}