<?php

namespace App\Http\Controllers\master;

use App\Models\User;
use App\Models\master\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\master\TeamDataTable;

class TeamController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-team-list|master-team-create|master-team-edit|master-team-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-team-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-team-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-team-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TeamDataTable $dataTable)
    {
        return $dataTable->render('master.teams.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }

    public function addUsersView($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $team = Team::findOrFail($id);

        $users = User::where('status',1)->get();

        $user_team = $team->users->pluck('fname','fname')->toArray();

        return view('teams.add_users',compact('team','users','user_team'));
    }

    public function addUsers(Team $team, Request $request)
    {
        if(!empty($request->users)){
            $team->users()->sync([$request->users]);
        }

        return redirect()->route('teams.index')->with('success','Users Added');

    }
}
