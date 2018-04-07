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
use App\Jobs\sendApprovalNotificationEmail;
use App\config;
class ReqController extends Controller
{
	
	public function __construct()
    {
		//$this->middleware('auth', ['except' => ['show','update']]);
       $this->middleware('auth')->except(['update', 'show', 'index']);
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
		if(Auth::user()->isApprover() || Auth::user()->isAdmin()){
		$req = req::with('user')->where('catname', Auth::user()->company)->orderby('created_at', 'desc')->paginate(20);
		}
		else{
		$req = req::with('user')->where('catname', Auth::user()->company)->where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->paginate(20);
		}
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
		$u = User::where('id', Auth::user()->id)->first();
		$conf = User::where('company', '=', $u->company)->where('approver', 1)->first();
		dispatch(new SendNewRequestEmail($r, $u, $conf));
		//Mail::to('hallitee_2005@yahoo.com')->send(new NewRequestEmail($r, Auth::user()));
		return redirect('home')->with('status', 'MID Request for '.$r->item_type.' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\req  $req
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        //
		echo "Trueest ";
		
		$this->emailApp($req);
    }
	    public function emailApp(Request $req)
    {
        //
		if($req->has('approver')){
		$user = user::where('approver', 1)->where('id', $req->approver)->first();
		$request = req::with('user')->where('id', $req->id)->first();
		$conf = config::where('company', $user->company)->first();
		if($request->approved == 0){
		$request->approved = $req->approval;	
		$request->approver = $user->id;
		$request->appr_name = $user->name;
		$request->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		$request->save();
		if($req->approval == 1){
		$conf = config::where('company', $req->user->company)->first();
		$u = User::where('id',$req->user_id)->first();
		$conf = config::where('company', '=', $u->company)->first();
		dispatch(new sendApprovalNotificationEmail($req, $user, $conf));
		return redirect('req')->with('status', 'Approved successfully, MID Creator will be notified through Email');
										}
				else{
				return redirect('req')->with('status', 'Request Not Approved');	
					}	
			}else{
			return redirect('req')->with('status', 'Request closed by '.$req->appr_name.' on '.$req->appr_date);	
			}		
			
		}
		else{
			return redirect('req')->with('status', 'Not authorized to approve request');	
		}

	
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
		if($request->has('approver')){
		$user = user::where('approver', 1)->where('id', $request->approver)->first();
		$req = req::with('user')->where('id', $request->id)->first();
		$conf = config::where('company', $user->company)->first();
		if($req->approved == 0){
		$req->approved = $request->approval;	
		$req->approver = $user->id;
		$req->appr_name = $user->name;
		$req->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		$req->save();
		if($request->approval == 1){
		$conf = config::where('company', $req->user->company)->first();
		$u = User::where('id',$req->user_id)->first();
		$conf = config::where('company', '=', $u->company)->first();
		dispatch(new sendApprovalNotificationEmail($req, $user, $conf));
		return redirect('req')->with('status', 'Approved successfully, MID Creator will be notified through Email');
										}
				else{
				return redirect('req')->with('status', 'Request Not Approved');	
					}	
			}else{
			return redirect('req')->with('status', 'Request closed by '.$req->appr_name.' on '.$req->appr_date);	
			}			
			
			
		}
		else{
		$user = Auth::user();
		$req = req::with('user')->find($request->id);
		if(Auth::user()->isApprover() || Auth::user()->isAdmin()){
		if($request->has('approval')){
		if($req->approved == 0){
		$req->approved = $request->approval;	
		$req->approver = $user->id;
		$req->appr_name = $user->name;
		$req->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		$req->save();
			if($request->approval == 1){
		$conf = config::where('company', $req->user->company)->first();
		$u = User::where('id',$req->user_id)->first();
		$conf = config::where('company', '=', $u->company)->first();
		dispatch(new sendApprovalNotificationEmail($req, $user, $conf));
		return redirect('req')->with('status', 'Approved successfully, MID Creator will be notified through Email');
										}
				else{
				return redirect('req')->with('status', 'Request Not Approved');	
					}	
			}else{
			return redirect('req')->with('status', 'Request closed by '.$req->appr_name.' on '.$req->appr_date);	
			}	
									}
		}
		else{
			return redirect('req')->with('status', 'Unauthorized to change request');	
			
		}
		}
	
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
