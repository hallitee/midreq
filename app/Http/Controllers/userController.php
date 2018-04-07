<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$user = user::paginate(20);
		return view('user.list')->with(['url'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('user.index');
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
		$s = new user;
		$s->name = $request->uName;
		$s->email = $request->uEmail;
		$s->password = bcrypt($request->uPwd);
		$s->save();
		return redirect('user')->with('status', $s->name.' created successfully');
		}

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$s = user::find($id);
		return view('user.edit')->with('s', $s);
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$s = user::find($request->id);
		$s->name = $request->uName;
		$s->email = $request->uEmail;
		$s->password = bcrypt($request->uPwd);
		$s->save();
		return redirect('user')->with('status', $s->name.' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
		$s = user::find($request->id);
		$s->delete();
		return redirect('user')->with('status', $s->name.' deleted successfully');		
    }
}
