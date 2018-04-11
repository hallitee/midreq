<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use App\subcategory;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public $subcat = ['QC Supports'=>'QC Supports', 'Spare parts'=>'Spare parts', 'Marketing Supports'=>'Marketing Supports', 'IT Supports'=>'IT Supports', 'Medical Support'=>'Medical Support',  'Office Supports'=>'Office  Supports', 'Household'=>'Household'];
	 
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
		$sc = subcategory::select('entitycode', 'U_IT_FAM')->where('entitycode', '01-234-002')->groupBy('entitycode', 'U_IT_FAM')->get();
		$subcat = [];
		array_unshift($this->subcat, " ");
		return view('user.index')->with('subcat', $this->subcat);
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
		$s->approver = $request->approver;

		$s->U_IT_FAM = $request->subCat;
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
		$s->company = $request->company;
		$s->approver = $request->approver;
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
