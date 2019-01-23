<?php

namespace App\Http\Controllers\Backend;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController.
 */
class CategoryController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Category $category)
    {

    	$categories = $category->all();
    	if(request()->wantsJson()){
    		return $categories;
    	};
        return view('backend.category.index', compact('categories'));
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
            'name' => 'required'
        ]);
        $category = Category::create($request->all());
       
        return back()->withFlashSuccess('Category Created!');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $user = User::find($id);
        $category->delete();
        return redirect()->back()->withFlashDanger('Category has been deleted Successfully');
    }
}
