<?php

namespace App\Http\Controllers\master;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\master\CourtCase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\master\CourtCaseDataTable;

class CourtCaseController extends Controller
{
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
        //
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
