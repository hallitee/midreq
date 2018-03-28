<?php
use App\subcategory;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\mail\NewRequestEmail;

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
Route::get('/mailable', function () {
    $invoice = "hallitee_2005@yahoo.com";

	
	return (new App\Mail\NewRequestEmail($invoice));
   // return view('email.newreq')->with('user', $invoice);
});
Route::get('/', function () {
    return view('index');
})->middleware('auth');
Route::get('/getitem', function(Request $req) {
	$data = subcategory::where('name', 'LIKE', '%'.$req->name.'%')->get();
    return Response::json($data);
});
Route::get('admin', 'AdminController@index');
Route::resource('req', 'ReqController', ['parameters'=>['req'=>'id']]);
Route::resource('group', 'GroupController', ['parameters'=>['group'=>'id']]);
Route::resource('family', 'FamilyController', ['parameters'=>['family'=>'id']]);
Route::resource('category', 'CategoryController', ['parameters'=>['category'=>'id']]);
Route::resource('subcategory', 'SubcategoryController', ['parameters'=>['subcategory'=>'id']]);
Auth::routes();
Route::get('/home', function(){
	return view('index');
})->name('home')->middleware('auth');