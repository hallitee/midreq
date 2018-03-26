<?php

namespace App\Http\Controllers;

use App\family;
use App\group;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$fam =  family::paginate(20);
		return view('family.list')->with('url', $fam);
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
		$grp = group::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}
		return view('family.index')->with('grp', $list);
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
		$validatedData = $request->validate([
        'famName' => 'bail|required|unique:family|max:255',
		]);
		$fam = new family;
		$fam->name = strtoupper($request->famName);
		$fam->group_id = $request->famGrp;
		$fam->id = family::with('group')->where('group_id', $request->famGrp)->count()+1;
		$fam->save();
		return redirect('family')->with('status',$fam->name.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$list = [];
		$grp = group::all();
		foreach($grp as $key=>$g){
			$list[$g->id] = $g->name;
		}		
		$fam = family::find($id);
		return view('family.edit')->with(['fam'=>$fam, 'grp'=>$list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$fam = family::find($request->id);
		$fam->name = $request->famName;
		$fam->group_id = $request->famGrp;
		$fam->save();
		return redirect('family')->with('status',$fam->name.' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
		$fam = family::find($request->id);
		$fam->delete();
		return redirect('family')->with('status',$fam->name.' deleted successfully');
		
    }
}
