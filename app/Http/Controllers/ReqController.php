<?php

namespace App\Http\Controllers;

use App\req;
use App\category;
use Illuminate\Http\Request;

class ReqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$list = category::all();
		$cat=[];
		foreach($list as $l){
			$cat[$l->id] = $l->id.' '.$l->name;
		}
		return view('req.index')->with('cat', $cat);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function show(req $req)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function edit(req $req)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, req $req)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function destroy(req $req)
    {
        //
    }
}
