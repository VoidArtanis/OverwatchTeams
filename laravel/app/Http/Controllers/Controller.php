<?php

namespace App\Http\Controllers;

use App\Models\Scrim;
use App\Models\TagRequests;
use App\Models\TeamRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // $hasTagRequests = TagRequests::hasRequests();
            if (!Auth::guest()) {
                $hasTagRequests = TeamRequests::hasRequests();
                $hasTagRequests =$hasTagRequests || Scrim::hasScrimRequests();
                $user = Auth::user();
                if (empty($user['country']) && empty($user['regfillshowed'])) {
                    if (strpos($request->url(), 'registerfill') === false) {
                        return redirect('registerfill');
                    }
                }
                View::share('hasTagRequests', $hasTagRequests);
            }
            return $next($request);
        });
    }
}
