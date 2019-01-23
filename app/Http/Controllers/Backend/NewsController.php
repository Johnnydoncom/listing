<?php

namespace App\Http\Controllers\Backend;

use App\News;
use App\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $newscategories = NewsCategory::all();
        $allnews = News::with('category')->latest()->paginate(10);
        return view('backend.news.index', compact('allnews','newscategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'image' => $featured_image_name ?? null
        ]);
        if($request->wantsJson()){
            return $news;
        }
        return redirect()->back()->with('flash_success', 'Your post has been submit and would be visible after approval!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $newscategories = NewsCategory::all();
        return view('backend.news.show', compact('newscategories', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        unlink( public_path('img/frontend/uploads/'.$news->featuredImage()) );
        $news->delete();
        return redirect()->route('admin.news.index')->withFlashSuccess('News Deleted!');
    }


    /**
     * Approve the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $news = News::find($request->news);
        $updateData = ($news->active == 1) ? 0 : 1;
        $news->active = $updateData;
        $news->save();
        return redirect()->back();
    }
}
