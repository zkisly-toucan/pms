<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function project($id)
    {
        $group = Group::find($id)->with('owner')->first();
        $secrets = Secret::where('group_id', $id)->get();
        return view('project')->with(['group' => $group, 'secrets' => $secrets]);
    }

    /**
     * get all groups available data with all secrets
     *
     */
    public function apiGroup(){
        return $groups = Group::with('owner')->with('secrets')->get();
    }

    /**
     * get all groups available data with all secrets
     * @param Request $request
     * @return Group[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function addGroup(Request $request){
        $count = Group::all()->count();
        $name = $request->name;
        var_dump($name);
        $group = Group::firstOrCreate([
            'name' => $name
        ],[
            'name' => $name,
            'owner_id' => Auth::user()->id,
            'level' => 10,
            'private' => 1,
        ]);
        return $group->id;

        //return $groups = Group::with('owner')->with('secrets')->get();
    }
}
