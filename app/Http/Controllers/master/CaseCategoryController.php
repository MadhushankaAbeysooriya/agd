<?php

namespace App\Http\Controllers\master;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master\CaseCategory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\master\StoreCaseCategory;
use App\DataTables\master\CaseCategoryDataTable;
use App\Http\Requests\master\UpdateCaseCategory;
use App\Http\Requests\master\StoreCaseCategoryRequest;
use App\Http\Requests\master\UpdateCaseCategoryRequest;

class CaseCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-case-category-list|master-case-category-create|master-case-category-edit|master-case-category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-case-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-case-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-case-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CaseCategoryDataTable $dataTable)
    {
        return $dataTable->render('master.case_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.case_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            // Create the team
            CaseCategory::create($request->all());

            // Commit the transaction
            DB::commit();

            return redirect()->route('case_categories.index')->with('success', 'Case Category created');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error creating Case Category: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('case_categories.index')->with('error', 'An error occurred while creating the case category. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $case_category = CaseCategory::find($id);

        return view('master.case_categories.show',compact('case_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $case_category = CaseCategory::find($id);

        return view('master.case_categories.edit',compact('case_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseCategoryRequest $request, CaseCategory $case_category)
    {
        DB::beginTransaction();

        try {
            // Update the team
            $case_category->update($request->toArray());

            // Commit the transaction
            DB::commit();

            return redirect()->route('case_categories.index')->with('success', 'Case Category Updated');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error updating case category: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('case_categories.index')->with('error', 'An error occurred while updating the case category. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $case_category = CaseCategory::find($id);

        $case_category->delete();

        return redirect()->route('case_categories.index')->with('success', 'Case Category Deleted');
    }
}
