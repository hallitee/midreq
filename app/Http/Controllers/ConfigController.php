<?php

namespace App\Http\Controllers;

use App\config;
use Illuminate\Http\Request;

class ConfigController extends Controller
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
		return view('config.index');
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
		$con = new config;
		$con->creator = $request->email;
		$con->hod = $request->hod;
		$con->company = $request->company;
		$con->save();
		return redirect('home')->with('status', "Saved successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(config $config)
    {
        //
    }
}
