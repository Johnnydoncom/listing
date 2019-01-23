<?php

namespace App\Http\Controllers\Frontend\User;


use App\Http\Controllers\Controller;
use App\News;
use App\Listing;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;


/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$allnews = News::approvedNews()->latest()->take(3)->get();
        return view('frontend.user.dashboard', compact('allnews'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile($username=null)
    {	if($username){
    		$user = User::where('username','=',$username)->whereActive('1')->firstOrFail();
    	}else{
    		$user = Auth::user();
    	}
    	$allnews = $user->news()->latest()->take(3)->get();
        return view('frontend.user.dashboard', compact('allnews','user'));
    }
}
