<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use Charts;


class ChartController extends Controller
{
  public function chart()
  {

    //Vote count per candidate


    //Vote count per county
    $chartCounty = Charts::database(votes::all(),'pie','highcharts')
     ->title('Voter Turnout by County')
     ->Responsive(false)
     ->Width(0)
     ->template('material')
     ->groupBy('county');

    //Vote count per gender
    $chartGender = Charts::database(votes::all(),'donut','highcharts')
      ->title('Voter Turnout by Gender')
      ->Responsive(false)
      ->Width(0)
      ->groupBy('Gender')
      ->template('material')
      ->colors(['red', 'blue', 'yellow']);


    //Vote count per age group
    $under24 = \DB::table('votes')->where('age', '<', '25')->count();
    $b25and49 = \DB::table('votes')->where([['age', '>=', '25'],['age', '<', '50']])->count();
    $b50and64 = \DB::table('votes')->where([['age', '>=', '50'],['age', '<', '65']])->count();;
    $over65 = \DB::table('votes')->where('age', '>', '64')->count();
    $chartAge = Charts::create('bar', 'highcharts')
      ->title("Voter Turnout by Age Group")
      ->elementLabel("Votes")
      ->responsive(false)
      ->dimensions(0, 400)
      ->labels(['18-24', '25-49', '50-64', '64+'])
      ->values([$under24, $b25and49, $b50and64, $over65])
      ->colors(['blue', 'red', 'green', 'yellow']);




     return view('result',['chartCounty'=>$chartCounty,'chartGender'=>$chartGender, 'chartAge'=>$chartAge]);
  }
}
