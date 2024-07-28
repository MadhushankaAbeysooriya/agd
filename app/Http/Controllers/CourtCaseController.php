<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CourtCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\CourtCaseDataTable;

class CourtCaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-case-list|master-case-create|master-case-edit|master-case-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-case-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-case-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-case-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CourtCaseDataTable $dataTable)
    {
        return $dataTable->render('court_cases.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CourtCase $courtCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourtCase $courtCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourtCase $courtCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourtCase $courtCase)
    {
        //
    }

    public function addCourtCaseView($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_case = CourtCase::findOrFail($id);

        $users = User::all();

        $user_case = $court_case->users->pluck('fname','fname')->toArray();

        return view('court_cases.add_users',compact('court_case','user_case','users'));
    }

    public function addCourtCaseStore(CourtCase $court_case, Request $request)
    {
        if(!empty($request->users)){
            $court_case->users()->sync([$request->users]);
        }

        return redirect()->route('court_cases.index')->with('success','Counsellors Added');

    }
}
