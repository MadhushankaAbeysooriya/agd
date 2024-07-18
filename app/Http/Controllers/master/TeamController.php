<?php

namespace App\Http\Controllers\master;

use App\Models\master\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
