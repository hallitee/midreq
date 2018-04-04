<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\req;
use App\User;
use App\category;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\groupReq;
use Illuminate\Support\Facades\Mail;
use App\mail\NewRequestEmail;
use App\Jobs\SendNewRequestEmail;
use App\config;
class ReqController extends Controller
{
	
	public function __construct()
    {
       $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$creator = config::where('company', Auth::user()->company)->first();
		$req = req::with('user')->where('catname', Auth::user()->company)->paginate(10);
		return view('req.list')->with(['url'=>$req, 'crt'=>$creator]);

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
    public function store(groupReq $request)
    {
        //
		
		$r = new Req;
		$r->item_type = $request->itemType;
		$r->descr = $request->itemDesc;
		$r->mat_type = $request->matType;
		$r->brand = $request->brand;
		$r->user_id = Auth::user()->id;
		$r->catname = Auth::user()->company;
		$r->save();
		//$u = User::where('id', Auth::user()->id)->first();
		//$conf = config::where('company', '=', $u->company)->first();
		//dispatch(new SendNewRequestEmail($r, $u, $conf));
		//Mail::to('hallitee_2005@yahoo.com')->send(new NewRequestEmail($r, Auth::user()));
		return redirect('home')->with('status', 'MID Request for '.$r->item_type.' created successfully');
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
    public function edit($id)
    {
      	$creator = config::where('company', Auth::user()->company)->first(); 
		$req = req::with('user')->find($id);
		$user = Auth::user();
		return view('req.edit')->with(['req'=>$req, 'user'=>$user, 'crt'=>$creator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$user = Auth::user();
		$req = req::find($request->id);
		if(Auth::user()->isApprover() || Auth::user()->isAdmin()){
		if($request->has('approval')){
		$req->approved = $request->approval;	
		$req->approver = $user->id;
		$req->appr_name = $user->name;
		$req->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		}
		}
		$req->save();
		$u = User::where('id',$req->user_id)->first();
		$conf = config::where('company', '=', $u->company)->first();
		dispatch(new SendNewRequestEmail($req, $u, $conf));
		return redirect('req')->with('status', 'Approved successfully, MID Creator will be notified through Email');
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
