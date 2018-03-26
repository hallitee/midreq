<?php

namespace App\Http\Controllers;

use App\subcategory;
use App\category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$url = subcategory::paginate(20);
		return view('subcat.list')->with(['url'=>$url]);		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$list = [];
		$grp = category::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}
		return view('subcat.index')->with('sub', $list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$cat = new subcategory;
		$cat->name = strtoupper($request->catName);
		$cat->cat_id = $request->catGrp;
		if($request->has('catId')){
		$cat->id = $request->catId;
		}
		else{
		$cat->id = subcategory::with('category')->where('cat_id', $request->catGrp)->count()+1;
		}
		$cat->save();
		return redirect('subcategory')->with('status',$cat->name.' subcategory created successfully');		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
		$list = [];
		$grp = family::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}		
		$cat = subcategory::find($id);
		return view('subcat.edit')->with(['cat'=>$cat, 'fam'=>$list]);			
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$cat = category::find($request->id);
		$cat->name = $request->catName;
		$cat->cat_id = $request->catGrp;
		$cat->save();
		return redirect('subcategory')->with('status',$cat->name.' subcategory updated successfully');			
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(subcategory $subcategory)
    {
        //
		$cat = subcategory::find($request->id);
		$cat->delete();
		return redirect('subcategory')->with('status',$cat->name.' subcategory deleted successfully');			
    }
}
