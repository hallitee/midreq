<?php
use App\subcategory;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\mail\NewRequestEmail;
use App\req;
use App\User;
use App\config;
use Carbon\Carbon;
use App\Jobs\SendNewRequestEmail;
use App\Jobs\sendApprovalNotificationEmail;
use App\Jobs\sendNotApproveEmail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/appRemarks', 'ReqController@remarks');
Route::get('/testNewEmail', function () {
		$r = req::with('user')->where('id', 63)->first();
		$u = User::where('id', $r->user->id)->first();
		$conf = User::where('company', '=', $u->company)->where('approver', 1)->first();
		dispatch(new SendNewRequestEmail($r, $u, $conf));
		echo "sent successfully";
		echo $r;
});
Route::get('/mailable', function () {
    $invoice = "hallitee_2005@yahoo.com";
	$user =User::where('id', 8)->first();
	$req = req::where('id', 69)->first();
	$app = User::where('approver', 1)->where('U_IT_FAM', 'IT Supports')->get();
	//return (new App\Mail\NewRequestEmail($invoice));
   // return view('email.newreq')->with(['user'=>$user, 'req'=>$req, 'conf'->$app]);
   foreach($app as $a){
   dispatch(new SendNewRequestEmail($req, $user, $a));
   }
   return view('email.newapp')->with(['req'=>$req,'user'=>$user,'conf'=>$app]);
});
Route::get('/mailableb', function () {
    $invoice = "hallitee_2005@yahoo.com";
	//$user =User::where('id', 8)->first();
	$req = req::with('user')->where('id', 63)->first();
	$user = User::where('approver', 1)->where('company', $req->user->company)->first();
	$app =  config::where('company', $req->user->company)->first();
	//return (new App\Mail\NewRequestEmail($invoice));
   // return view('email.newreq')->with(['user'=>$user, 'req'=>$req, 'conf'->$app]);
   return view('email.appreq')->with(['req'=>$req,'user'=>$user,'conf'=>$app]);
});
Route::get('/', function () {
    return view('index');
})->middleware('auth');
//Route::get('emailApp/{id}', 'ReqController@emailApp')->name('req.emailApp');
Route::get('emailApp', function(Request $req){
		$user = user::where('approver', 1)->where('id', $req->approver)->first();
		$request = req::with('user')->where('id', $req->id)->first();
		$conf = config::where('company', $request->user->company)->first();	
	if($req->has('approver') && ($user->U_IT_FAM == $request->subcatname) && $user->role==2 ){   //check request has approver

		if($request->approved == 0){			//check request has already been approved / unapproved
		$request->approved = $req->approval;	
		$request->approver = $user->id;
		$request->appr_name = $user->name;
		$request->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		if($req->has('remarks')){
			$request->reqstatus = $req->remarks;
		}
		$request->save();
		if($req->approval == 1){
		
		$conf = config::where('company', '=', $request->user->company)->first();
		dispatch(new sendApprovalNotificationEmail($request, $user, $conf));
		return view('req.emailapp')->with(['status'=>'Approved successfully, MID Creator will be notified through Email', 'req'=>$request, 'crt'=>$conf]);
										}
				else{
					dispatch(new sendNotApproveEmail($request, $user, $conf));	
				return view('req.emailapp')->with(['status'=>'Request declined Successfully', 'req'=>$request, 'crt'=>$conf]);	
					}	
			}else{
			
			return view('req.emailapp')->with(['status'=>'Request closed by '.$request->appr_name.' on '.$request->appr_date, 'req'=>$request, 'crt'=>$conf]);	
			}		
			
		}
		else{
			if($user->approver && $user->role==1){
		if($request->approved == 0){			//check request has already been approved / unapproved
		$request->approved = $req->approval;	
		$request->approver = $user->id;
		$request->appr_name = $user->name;
		$request->appr_date = Carbon::now()->format('Y-m-d H:i:s');
		$request->save();
		if($req->approval == 1){
		$u = User::where('id',$request->user_id)->first();
		$conf = config::where('company', '=', $u->company)->first();
		dispatch(new sendApprovalNotificationEmail($request, $user, $conf));
		return view('req.emailapp')->with(['status'=>'Approved successfully, MID Creator will be notified through Email', 'req'=>$request, 'crt'=>$conf]);
										}
				else{
					dispatch(new sendNotApproveEmail($request, $user, $conf));	
				return view('req.emailapp')->with(['status'=>'Request declined successfully', 'req'=>$request, 'crt'=>$conf]);	
					}	
			}else{
			return view('req.emailapp')->with(['status'=>'Request closed by '.$request->appr_name.' on '.$request->appr_date, 'req'=>$request, 'crt'=>$conf]);	
			}				
				
				
			}
			else{
			return view('req.emailapp')->with(['status'=>'Not authorized to approve request', 'req'=>$request, 'crt'=>$conf]);	
			
			}
		}
		
})->name('emailApp');
Route::get('/getitem', 'SubcategoryController@getitem');
Route::get('admin', 'AdminController@index');
Route::resource('user', 'userController', ['parameters'=>['user'=>'id']]);
Route::resource('config', 'ConfigController', ['parameters'=>['config'=>'id']]);
Route::resource('req', 'ReqController', ['parameters'=>['req'=>'id']]);
Route::resource('group', 'GroupController', ['parameters'=>['group'=>'id']]);
Route::resource('family', 'FamilyController', ['parameters'=>['family'=>'id']]);
Route::resource('category', 'CategoryController', ['parameters'=>['category'=>'id']]);
Route::resource('subcategory', 'SubcategoryController', ['parameters'=>['subcategory'=>'id']]);
Auth::routes();
Route::get('/home', function(){
	return view('index');
})->name('home')->middleware('auth');