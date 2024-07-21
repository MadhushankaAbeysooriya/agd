<?php

namespace App\Http\Controllers\master;

use Exception;
use App\Models\User;
use App\Models\master\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\master\TeamDataTable;
use App\Http\Requests\master\StoreTeamRequest;
use App\Http\Requests\master\UpdateTeamRequest;

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
        $users = User::all();
        return view('master.teams.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();

        try {
            // Create the team
            $team = Team::create($request->all());

            // Sync users
            if (!empty($request->users)) {
                $team->users()->sync($request->users);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('teams.index')->with('success', 'Team created');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error creating team: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('teams.index')->with('error', 'An error occurred while creating the team. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $team = Team::find($id);

        return view('master.teams.show',compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $team = Team::find($id);

        $users = User::all();

        $user_teams = $team->users->pluck('fname','fname')->toArray();

        return view('master.teams.edit',compact('team','users','user_teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        DB::beginTransaction();

        try {
            // Update the team
            $team->update($request->toArray());

            // Sync or detach users
            if (!empty($request->users)) {
                $team->users()->sync($request->users);
            } else {
                $team->users()->detach();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('teams.index')->with('success', 'Team Updated');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error updating team: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('teams.index')->with('error', 'An error occurred while updating the team. Please try again.');
        }
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

        $users = User::all();

        $user_team = $team->users->pluck('fname','fname')->toArray();

        return view('master.teams.add_users',compact('team','users','user_team'));
    }

    public function addUsers(Team $team, Request $request)
    {
        if(!empty($request->users)){
            $team->users()->sync([$request->users]);
        }

        return redirect()->route('teams.index')->with('success','Users Added');

    }
}
