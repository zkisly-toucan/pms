<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Secret;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('owner')->with('secrets')->get();
        return view('projects')->with('groups', $groups);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function project($id)
    {
        $group = Group::find($id)->with('owner')->first();
        $secrets = Secret::where('group_id', $id)->get();
        return view('project')->with(['group' => $group, 'secrets' => $secrets]);
    }
}
