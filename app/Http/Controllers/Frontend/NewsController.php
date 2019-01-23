<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Auth;
use App\NewsCategory;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allnews = News::where('active','=',1)->paginate(5);
        return view('frontend.news.index', compact('allnews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $newscategories = NewsCategory::all();
        return view('frontend.news.create', compact('newscategories'));
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
            'featured_image' => $featured_image_name ?? null
        ]);
        if($request->wantsJson()){
            return $news;
        }
        return redirect()->back()->with('flash_success', 'Your post has been submit and would be visible after approval!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::whereSlug($slug)->first();
        return view('frontend.news.show', compact('news'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
