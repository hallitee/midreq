<?php

namespace App\Http\Controllers;

use App\group;
use Illuminate\Http\Request;
use App\Http\Requests\groupReq;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$grp = group::paginate(5);
		return view('group.list')->with('url', $grp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		
		return view('group.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(groupReq $request)
    {
        //
		$grp = new group;
		$grp->name = strtoupper($request->grpName);
		$grp->save();
		return redirect('group')->with('status', ucfirst($grp->name).' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
		$grp = group::find($request->id);
		return view('group.edit')->with('grp', $grp);
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
			$grp = group::find($request->id);
			if($request->has('grpName')){
				$grp->name = $request->grpName;
			}
			$grp->save();
		    return redirect('group')->with('status', $grp->name.' updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        //
        $l = group::find($req->id);
        $m = $l;
        $l->delete();
        return redirect('group')->with('status', $m->name.' deleted Successfully');		
		
    }
}
