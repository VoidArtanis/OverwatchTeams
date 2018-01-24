<?php

namespace App\Http\Controllers;

use App\Data\HeroKeys;
use App\Data\HeroNames;
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

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $inRange = false;
        if (Input::get('inrange')) {
            $inRange = true;
        }

        $users = null;
        $hero = 'genji';


        if (Input::get('hero')) {
            $hero = Input::get('hero');
        }


        $srcompat=true;
        if (!Input::get('sr-compat')) {
            $srcompat=false;
        }

        $region = Input::get('region');
        $cRegion = Input::get('region');
        if ($region && ($region == 'us' || $region == 'kr' || $region == 'eu')) {
            $cRegion=$region;
        }  else
        {
            $cRegion = 'us';
        }

        $srMax=0;
        $srMin=0;
        if (!Auth::guest()){
            $loggedUser = Auth::user();
            $sr = $loggedUser[$cRegion]['stats']['competitive']['overall_stats']['comprank'];
            $srMax = $sr + 500;
            $srMin = $sr - 500;
        }

        $sort = 1;
        $sortBy = 'time-desc';
        $sortQuery=$cRegion . '.heroes.playtime.competitive.' . $hero;

        if (Input::get('sort')) {
            $sortBy = Input::get('sort');
        }


        switch ($sortBy) {
            case 'time-desc':
                $sort = -1;
                $sortQuery=$cRegion . '.heroes.playtime.competitive.' . $hero;
                break;
            case 'time-asc':
                $sort = 1;
                $sortQuery=$cRegion . '.heroes.playtime.competitive.' . $hero;
                break;
            case 'games-desc':
                $sort = -1;
                $sortQuery=$cRegion . '.heroes.stats.competitive.' . $hero . '.average_stats.games_played';
                break;
            case 'games-asc':
                $sort = 1;
                $sortQuery=$cRegion . '.heroes.stats.competitive.' . $hero . '.average_stats.games_played';
                break;
            case 'sr-desc':
                $sort = -1;
                $sortQuery=$cRegion . '.stats.competitive.overall_stats.comprank';
                break;
            case 'sr-asc':
                $sort = 1;
                $sortQuery=$cRegion . '.stats.competitive.overall_stats.comprank';
                break;
        }

        if($srcompat){
            $users = DB::collection('users')->whereRaw([$cRegion . '.heroes.playtime.competitive.' . $hero => ['$gt' => 0],$cRegion . '.stats.competitive.overall_stats.comprank' => ['$gte' => $srMin, '$lte'=>$srMax] ])->orderBy($sortQuery, $sort)->paginate(50)->appends(Input::except('page'));

        }else{
            $users = DB::collection('users')->whereRaw([$cRegion . '.heroes.playtime.competitive.' . $hero => ['$gt' => 0]])->orderBy($sortQuery, $sort)->paginate(50)->appends(Input::except('page'));
        }

        $main_hero = null;
        $sortedHeroes= HeroNames::$data;
        ksort($sortedHeroes);
        return view('search', [
            'users' => $users,
            'heroes' => $sortedHeroes,
            'rank_images' => RankImage::$data,
            'hero' => $hero,
            'sortby' =>$sortBy,
            'srcompat' =>$srcompat,
            'cRegion' =>$cRegion,
            'regions' =>Regions::$data,
        ]);
    }
}
