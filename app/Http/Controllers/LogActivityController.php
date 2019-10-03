<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }

    /**
     * Add log activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToLog()
    {
        \LogActivity::addToLog('Log Activity.');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('manage.logActivity',compact('logs'));
    }

    public function destroyLog($id)
    {
        $logs = \LogActivity::deleteLog($id);
    }
}
