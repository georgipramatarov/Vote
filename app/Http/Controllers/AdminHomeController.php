<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function __construct()
  {
      $this->middleware('admin.user');
  }

    public function index()
    {
      return view("admin-home");
    }


}
