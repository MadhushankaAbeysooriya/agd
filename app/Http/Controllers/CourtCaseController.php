<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\CourtCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\CourtCaseDataTable;
use App\Http\Requests\StoreCourtCaseRequest;
use App\Http\Requests\UpdateCourtCaseRequest;
use App\Models\master\CaseCategory;
use App\Models\master\Court;

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
        $courts = Court::all();
        $case_categories = CaseCategory::all();

        return view('court_cases.create',compact('courts','case_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourtCaseRequest $request)
    {
        DB::beginTransaction();

        try {
            // Create the CourtCase
            $court_case = CourtCase::create($request->all());

            // Sync case categories
            if (!empty($request->case_categories)) {
                $court_case->casecategories()->sync($request->case_categories);
            }

            // Create status
            $court_case->casestatuses()->create([
                'status' => 0,
            ]);


            // Commit the transaction
            DB::commit();

            return redirect()->route('court_cases.index')->with('success', 'Case created');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error creating case: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('court_cases.create')->with('error', 'An error occurred while creating the Case. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_case = CourtCase::find($id);

        return view('court_cases.show',compact('court_case'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_case = CourtCase::find($id);

        $courts = Court::all();

        $case_categories = CaseCategory::all();

        $court_case_categories = $court_case->casecategories->pluck('name','name')->toArray();

        return view('court_cases.edit',compact('court_case','courts','case_categories','court_case_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourtCaseRequest $request, CourtCase $court_case)
    {
        DB::beginTransaction();

        try {
            // Update the team
            $court_case->update($request->toArray());

            // Sync or detach users
            if (!empty($request->case_categories)) {
                $court_case->casecategories()->sync($request->case_categories);
            } else {
                $court_case->casecategories()->detach();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('court_cases.index')->with('success', 'Case updated');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error updating case: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('court_cases.create')->with('error', 'An error occurred while updating the case. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_case = CourtCase::find($id);

        $court_case->delete();

        return redirect()->route('court_cases.index')->with('success', 'Court Case Deleted');
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
        $request->validate([
            'users' => 'array',
            'users.*' => 'exists:users,id'
        ]);

        if(!empty($request->users)){
            $court_case->users()->sync($request->users);
        }

        return redirect()->route('court_cases.index')->with('success', 'Counsellors Added');
    }
}
