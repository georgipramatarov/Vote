<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Votes;
use Charts;


class ChartController extends Controller
{
  public function chart()
  {
    $chart = Charts::database(votes::all(),'pie','highcharts')
     ->title('county')
     ->Responsive(false)
     ->Width(0)
     ->groupBy('county')
     ->colors(['#ff0000', 'blue','green','red']);

     $chartGender = Charts::database(votes::all(),'bar','highcharts')
      ->title('Gender')
      ->Responsive(false)
      ->Width(0)
      ->groupBy('Gender')
      ->colors(['#ff0000', 'blue','green','red']);

     return view('result',['chart'=>$chart,'chartGender'=>$chartGender ]);
  }
}
