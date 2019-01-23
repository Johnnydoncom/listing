<?php

namespace App\Http\Controllers\Frontend\User;

use App\Listing;
use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$mylisting = Auth::user()->listing()->get();
        return view('frontend.user.account', compact('mylisting'));
    }



    // Listing
        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing_index()
    {
    	$listings = Auth::user()->listing()->get();
        return view('frontend.user.listing.index', compact('listings'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing_create()
    {
    	return view('frontend.user.listing.create');
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing_store(Request $request)
    {
    	$request->validate([
            'title' => 'required',
            'description'   =>  'required',
//            'price' =>  'required',
            'category'   =>'required',
            'make'   =>  'required',
            'location' => 'required',
            'year'  =>'required'
        ]);

        if($request->get('featured_image')){
          $featured_image = $request->get('featured_image');
          $featured_image_name = str_slug($request->title).'_'.time().'.' . explode('/', explode(':', substr($featured_image, 0, strpos($featured_image, ';')))[1])[1];
          \Image::make($request->get('featured_image'))->save(public_path('img/frontend/uploads/').$featured_image_name);
        }

        $listing = Listing::create([
            'title' => $request->title,
            'user_id'   =>  Auth::id(),
            'category_id'   => $request->category,
            'make_id'  =>  $request->make,
            'carmodel_id' =>  $request->model,
            'price' =>  $request->price,
            'description'   =>  $request->description,
            'featured_image' => $featured_image_name,
            'year'  =>  $request->year,
            'location' => $request->location,
            'is_offer'  =>  $request->offer ?? 0
        ]);
        if($request->wantsJson()){
        	return $listing;
        }
        return redirect()->back()->with('flash_success', 'Your post has been submit and would be visible after approval!');;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing_show(Listing $listing)
    {
    	return view('frontend.user.listing.edit',compact('listing'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listing_update(Request $request, Listing $listing)
    {
    	$request->validate([
            'title' => 'required',
            'description'   =>  'required',
//            'price' =>  'required',
            'category'   =>'required',
            'make'   =>  'required',
            'location' => 'required',
            'year'  =>'required'
        ]);

         $update_data = array(
        	'title' => $request->title,
            'category_id'   => $request->category,
            'make_id'  =>  $request->make,
            'carmodel_id' =>  $request->model,
            'price' =>  $request->price,
            'description'   =>  $request->description,
            'year'  =>  $request->year,
            'location' => $request->location,
            'is_offer'  =>  $request->offer ?? 0
        );


        if($request->get('featured_image')){
          $featured_image = $request->get('featured_image');
          $featured_image_name = str_slug($request->title).'_'.time().'.' . explode('/', explode(':', substr($featured_image, 0, strpos($featured_image, ';')))[1])[1];
          \Image::make($request->get('featured_image'))->save(public_path('img/frontend/uploads/').$featured_image_name);

          $update_data['featured_image'] =  $featured_image_name;
        }

       
        $update_listing = $listing->update($update_data);
        if($request->wantsJson()){
        	return $listing;
        }
        return redirect()->back()->with('flash_success', 'Your post has been updated and would be visible after approval!');
    }


    // News
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news_index()
    {
    	$news = Auth::user()->news()->get();
        return view('frontend.user.news.index', compact('news'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news_create()
    {
    	$newscategories = NewsCategory::all();
    	return view('frontend.user.news.create', compact('newscategories'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news_store(Request $request)
    {
    	$request->validate([
            'title' => 'required',
            'description' =>  'required',
            'category'   =>'required',
        ]);

        if($request->file('featured_image')){
          $featured_image = $request->file('featured_image');
          $imageName = $featured_image->getClientOriginalName();

          $featured_image_name = str_slug($request->title).'_' . $imageName;
          \Image::make($featured_image)->save(public_path('img/frontend/uploads/').$featured_image_name);
        }

        $news = News::create([
            'title' => $request->title,
            'author'   =>  Auth::id(),
            'category_id'   => $request->category,
            'description'   =>  $request->description,
            'image' => $featured_image_name ?? null
        ]);
        if($request->wantsJson()){
            return $news;
        }
        return redirect()->back()->with('flash_success', 'Your post has been submit and would be visible after approval!');;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news_show(News $news)
    {
    	$newscategories = NewsCategory::all();
    	return view('frontend.user.news.edit',compact('news','newscategories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news_update(Request $request, News $news)
    {
    	$request->validate([
            'title' => 'required',
            'description' =>  'required',
            'category'   =>'required',
        ]);

        if($request->file('featured_image')){
          $featured_image = $request->file('featured_image');
          $imageName = $featured_image->getClientOriginalName();

          $featured_image_name = str_slug($request->title).'_' . $imageName;
          \Image::make($featured_image)->save(public_path('img/frontend/uploads/').$featured_image_name);
        }

        $news->title = $request->title;
		$news->category_id = $request->category;
        $news->description = $request->description;

        if($request->file('featured_image')){
	        $news->image = $featured_image_name;
	    }
        $news->save();
      
        if($request->wantsJson()){
            return $news;
        }
        return redirect()->back()->with('flash_success', 'Your post has been updated and would be visible after approval!');;
    }

    public function news_destroy(News $news)
    {
    	unlink( public_path('img/frontend/uploads/'.$news->featuredImage()) );
        $news->delete();
        return redirect()->route('frontend.user.account.news.index')->withFlashSuccess('News Deleted!');
    }

}
