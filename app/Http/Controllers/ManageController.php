<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Purifier;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|editor|author|contributor');
    }

    public function index()
    {
      return redirect()->route('manage.dashboard');
    }

    public function dashboard()
    {
      return view('manage.dashboard');
    }

}
