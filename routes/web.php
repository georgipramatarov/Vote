<?php
use App\Notifications\create_new_election;
use Illuminate\Support\Facades\Input;
use App\Votes;

session_start();
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


//Vote authentication
Route::post('/',function(){
  $el_roll = DB::table('electoral_roll')->where('nino',Input::get('nationalinsuranceno'))->first();
  $temp = Input::get('dob-year'). "-" .Input::get('dob-month'). "-" .Input::get('dob-day') ;
  if($el_roll){

    if($el_roll->vac == Input::get('votecode') && $el_roll->dob == $temp && $el_roll->voted != 1){

      $_SESSION["auth"]=1;
      Session::put('vot',$el_roll);
      	return redirect()->route('vote_page'); //Random for fairness
    }else{
      //send back to login view with error
      return view('voter_login', ['error' => '1']);
  }
  }else{
    return view('voter_login', ['error' => '1']);
  }
});

Route::get('vote_page',function(){
  if(isset($_SESSION["auth"])){
    $elections = DB::table('elections')->where([
      ['close_date', '>', Carbon\Carbon::now()],
      ['start_date', '<=', Carbon\Carbon::now()]
      ]);
  $election = $elections->orderBy('start_date')->first(); // get latest electionID
  //get appropriate candidates in random order
  $cands = DB::table('candidates')->where('electionID', $election->id)->inRandomOrder()->get();
  //get the demographic data for the voter
  $voter = Session::get('vot');
  return view('vote', ['cands' => $cands, 'election' => $election, 'voter' => $voter]); //return view with data

}else{
  abort(403, 'Unauthorized action.');
}
})->name('vote_page');

//Cast vote
Route::post('vote_page',function(){
  if (! Session::has('vot')) { 
    abort('403', 'Unauthorized Action'); 
  }
  //Voter record for demographic and updating electoral roll
    $voterID = Session::get('vot')->id;
    $voter = DB::table('electoral_roll')->where('id',$voterID)->first();
    
    //Get election ID
    $electionID = DB::table('elections')->where([
      ['close_date', '>', Carbon\Carbon::now()],
      ['start_date', '<=', Carbon\Carbon::now()]
      ])->orderBy('start_date')->first();

    Votes::create([
      'cand_id' => Input::get('cand_id'),
      'Gender' => $voter->gender,
      'county' => $voter->county,
      'election_id' => $electionID->id,
    ]);

    //Update electoral roll
    DB::table('electoral_roll')->where('id', $voterID )->update(['voted' => 1]);

    //forget session
    Session::forget('vot');

    //send to votecomplete page
    return redirect()->route('vote_complete');

});
/*
//Auth
Route::post('/',function(){
  $nino = Input::get('nationalinsuranceno');
  $vac = Input::get('votecode');
  $dob = Input::get('dob-year') . "-" . Input::get('dob-month') . "-" . Input::get('dob-day');
  $qry = "SELECT Count(*) as total FROM electoral_roll WHERE (
    vac='$vac' AND
    nino='$nino' AND
    dob='$dob');";
    $val=DB::select($qry);

    if ($val[0]->total == 1){
      return view('vote');
    }else{
      $error='1';
      return view('voter_login', ['error' => '1']);
    }
});

*/

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
    $elections = DB::table('elections')->orderBy('id', 'DESC')->get();
    return view('election',compact('elections'));
});
Route::get('/admin_home/overview', function(){
    $admin_users = DB::table('admin_users')->get();
    return view('overview',compact('admin_users'));
});


//Generate polling cards
Route::get('/admin_home/pollingcards', function(){
    return view('polling_cards');
});
Route::get('/admin_home/pollingcards/generate', function(){
    return view('pdf/generatepollingcards');
});
Route::get('/admin_home/pollingcards/generateone', function(){
    return view('pdf/generatesinglecard');
});

//Generate VAC
Route::get('/admin_home/vac/generate', function(){
    return view('pdf/generatevac');
});
Route::get('/admin_home/votecodes', function(){
    return view('votecodes');
});

//view results
Route::get('admin_home/results','ChartController@chart');

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

//Vote complete
Route::get('vote_complete', function(){
    return view('vote_complete');
})->name('vote_complete');

