<?php

namespace App\Http\Controllers\Frontend;

use App\Listing;
use App\News;
use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$newsitems = News::approved()->latest()->take(9)->get();
    	$latestcarposts = Listing::approved()->latest()->take(3)->get();
        return view('frontend.index', compact('newsitems','latestcarposts'));
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }
}
