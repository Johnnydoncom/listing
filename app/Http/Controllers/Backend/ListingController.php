<?php

namespace App\Http\Controllers\Backend;

use App\Notifications\PostApproved;
use App\Notifications\PostDissApproved;
use Illuminate\Http\Request;
use App\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::latest()->paginate(20);
        return view('backend.listing.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.listing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description'   =>  'required',
            'price' =>  'required',
            'category'   =>'required',
            'make'   =>  'required',
            'model'  =>  'required',
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
            'model_id' =>  $request->model,
            'price' =>  $request->price,
            'description'   =>  $request->description,
            'featured_image' => $featured_image_name,
            'year'  =>  $request->year,
            'location' => $request->location,
            'is_offer'  =>  $request->offer
        ]);
        return $listing;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
         return view('backend.listing.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'title' => 'required',
            'description'   =>  'required',
            'price' =>  'required',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        unlink( public_path('img/frontend/uploads/'.$listing->featuredImg()) );
        $listing->delete();
        return redirect()->back()->withFlashSuccess('Listing Deleted!');
    }


    public function approval(Request $request)
    {
        $listing = Listing::findOrFail($request->listing_id);
        $updateData = $listing->approved == 1 ? 0 : 1;
        $listing->approved = $updateData;
        $listing->save();

        //Send email notification
        if($listing->approved == 1) {
            $listing->user->notify(new PostApproved($listing));
        }else{
            $listing->user->notify(new PostDissApproved($listing));
        }

        if($request->wantsJson()){
            return $listing;
        }
        return redirect()->back();
    }
}
