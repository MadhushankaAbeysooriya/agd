<?php

namespace App\Http\Controllers\master;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\master\CourtCategory;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\master\StoreCourtCategory;
use App\DataTables\master\CourtCategoryDataTable;
use App\Http\Requests\master\UpdateCourtCategory;

class CourtCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-court-category-list|master-court-category-create|master-court-category-edit|master-court-category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-court-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-court-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-court-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CourtCategoryDataTable $dataTable)
    {
        return $dataTable->render('master.court_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.court_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourtCategory $request)
    {
        DB::beginTransaction();

        try {
            // Create the team
            CourtCategory::create($request->all());

            // Commit the transaction
            DB::commit();

            return redirect()->route('court_categories.index')->with('success', 'Court Category created');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error creating court category: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('court_categories.index')->with('error', 'An error occurred while creating the court category. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_category = CourtCategory::find($id);

        return view('master.court_categories.show',compact('court_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_category = CourtCategory::find($id);

        return view('master.court_categories.edit',compact('court_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourtCategory $request, CourtCategory $court_category)
    {
        DB::beginTransaction();

        try {
            // Update the team
            $court_category->update($request->toArray());

            // Commit the transaction
            DB::commit();

            return redirect()->route('court_categories.index')->with('success', 'Court Category Updated');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error updating court category: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('court_categories.index')->with('error', 'An error occurred while updating the court category. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court_category = CourtCategory::find($id);

        $court_category->delete();

        return redirect()->route('court_categories.index')->with('success', 'Court Category Deleted');
    }
}
