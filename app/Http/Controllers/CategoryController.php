<?php

namespace App\Http\Controllers;

use App\category;
use App\family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$url = category::paginate(20);
		return view('category.list')->with(['url'=>$url]);
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
		$grp = family::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}
		return view('category.index')->with('cat', $list);
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
		$cat = new category;
		$cat->name = strtoupper($request->catName);
		$cat->family_id = $request->catGrp;
		if($request->has('catId')){
		$cat->id = $request->catId;
		}
		else{
		$cat->id = category::with('family')->where('family_id', $request->catGrp)->count()+1;
		}
		$cat->save();
		return redirect('category')->with('status',$cat->name.' category created successfully');		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$list = [];
		$grp = family::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}		
		$cat = category::find($id);
		return view('category.edit')->with(['cat'=>$cat, 'fam'=>$list]);		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$cat = category::find($request->id);
		$cat->name = $request->catName;
		$cat->family_id = $request->catFam;
		$cat->save();
		return redirect('category')->with('status',$cat->name.' category updated successfully');		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
		$cat = category::find($request->id);
		$cat->delete();
		return redirect('category')->with('status',$cat->name.' category deleted successfully');		
    }
}
