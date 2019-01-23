<?php

namespace App\Http\Controllers\Backend;
use App\Make;
use App\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController.
 */
class MakeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	
        if(request()->wantsJson()){
            return Make::with('model')->get();
        };
        $makes = Make::with('model')->paginate(10);
        return view('backend.make.index', compact('makes'));
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
        $category = Make::create($request->all());
       
        return back()->withFlashSuccess('Car Make Created!');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Make $make)
    {
        $models = CarModel::where('make_id','=',$make->id)->paginate(10);
        if(request()->wantsJson()){
            return CarModel::where('make_id','=',$make->id)->get();
        };
        return view('backend.make.show', compact(['make', 'models']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Make $make)
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
    public function update(Request $request, Make $make)
    {
         $request->validate([
            'name' => 'required'
        ]);

        $make->update($request->all());
       
        return back()->withFlashSuccess('Car Make Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Make $make)
    {
        $make->delete();
        return redirect()->back()->withFlashDanger('Make has been deleted Successfully');
    }

    public function storeModel(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'make_id'   =>  'required'
        ]);
        CarModel::create($request->all());
        return back()->withFlashSuccess('Car Model Created!');
    }

    public function delModel(CarModel $model)
    {
        # code...
    }
}
