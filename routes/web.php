<?php
use App\Notifications\create_new_election;
use Illuminate\Support\Facades\Input;
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

Route::get('/enc',function(){
    $el_users = DB::table('electoral_roll')->get();
    foreach ($el_users as $u) {

      DB::table('electoral_roll')->where('email', $u->email )->update(['email' => Hash::make($u->email)]);
    }
});

Route::get('/', function () {
    return view('voter_login');
});
Route::post('/',function(){
  $el_roll = DB::table('electoral_roll')->get();
  foreach ($el_roll as $i) {
    if($i->nino == Input::get('natioalinsuranceno') && $i->vac == Input::get('votecode')){
      return view('vote');
    }else{
      $error='1';
      return view('voter_login', ['error' => '1']);
    }
  }
});

Auth::routes();


Route::get('admin_login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin_login', 'AdminAuth\LoginController@login');
Route::post('admin_logout', 'AdminAuth\LoginController@logout');
Route::post('admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('admin_password/reset', 'AdminAuth\ResetPasswordController@reset');
Route::get('admin_password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
Route::get('admin_register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin_register', 'AdminAuth\RegisterController@register');

Route::group(['middleware' => 'App\Http\Middleware\DeniedIfNoAdmin'], function(){
Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'AdminAuth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'AdminAuth\LoginController@postValidateToken']);

Route::get('/admin_home', 'AdminHomeController@index');
Route::get('/admin_home/security', function(){
    return view('security');
});
Route::get('/admin_home/election', function(){
    return view('election');
});
Route::get('/admin_home/overview', function(){
    $admin_users = DB::table('admin_users')->get();
    return view('overview',compact('admin_users'));
});
Route::get('/admin_home/pollingcards', function(){
    return view('polling_cards');
});

//Generate polling cards
Route::get('/admin_home/pollingcards/generate', function(){
    return view('pdf/generatepollingcards');
});

//Generate VAC
Route::get('/admin_home/vac/generate', function(){
    return view('pdf/generatevac');
});

Route::get('/admin_home/votecodes', function(){
    return view('votecodes');
});

Route::post('/admin_home/overview', function(Request $request){
  if(isset($_POST['Grant'])){
    DB::table('admin_users')->where('id', Input::get('id') )->update(['authorize' => 1]);
    $admin_users = DB::table('admin_users')->get();
    return view('overview',compact('admin_users'));
  }elseif (isset($_POST['Deny'])) {
    DB::table('admin_users')->where('id', Input::get('id') )->delete();
    $admin_users = DB::table('admin_users')->get();
    return view('overview',compact('admin_users'));
  }
});

Route::get('/admin_home/create-election', 'ElectionController@create');
Route::post('/admin_home/create-election', 'ElectionController@store');

// do we use this !!!!
Route::get('/admin_home/create_election/noti',function(){
  $users=App\adminInfo::first();
  $electioncreate=App\createElection::first();
  $users->notify(new create_new_election($electioncreate));
});

});
Route::get('/vote', 'Auth\LoginController@showLoginForm');
Route::get('/candidates', 'CandidateController@index');
Route::get('/candidates/{candidate}', 'CandidateController@showimg');
