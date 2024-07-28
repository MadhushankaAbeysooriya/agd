<?php

namespace App\Http\Controllers\master;

use Exception;
use App\Models\master\Court;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\master\CourtDataTable;
use App\Http\Requests\master\StoreCourtRequest;
use App\Http\Requests\master\UpdateCourtRequest;
use App\Models\master\CourtCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class CourtController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:master-court-list|master-court-create|master-court-edit|master-court-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-court-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-court-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-court-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CourtDataTable $dataTable)
    {
        return $dataTable->render('master.courts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $court_categories = CourtCategory::all();
        return view('master.courts.create',compact('court_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourtRequest $request)
    {
        DB::beginTransaction();

        try {
            // Create the court
            $court = Court::create($request->all());

            // Sync court category
            if (!empty($request->court_categories)) {
                $court->courtcategories()->sync($request->court_categories);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('courts.index')->with('success', 'court created');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error creating court: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('courts.create')->with('error', 'An error occurred while creating the court. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court = Court::find($id);

        return view('master.courts.show',compact('court'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court = Court::find($id);

        $court_categories = CourtCategory::all();

        $court_court_categories = $court->courtcategories->pluck('name','name')->toArray();

        return view('master.courts.edit',compact('court','court_categories','court_court_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourtRequest $request, Court $court)
    {
        DB::beginTransaction();

        try {
            // Update the team
            $court->update($request->toArray());

            // Sync or detach users
            if (!empty($request->court_categories)) {
                $court->courtcategories()->sync($request->court_categories);
            } else {
                $court->courtcategories()->detach();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('courts.index')->with('success', 'Court Updated');
        } catch (Exception $e) {
            // Rollback the transaction
            DB::rollback();

            // Log the error for further investigation
            Log::error('Error updating court: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('courts.index')->with('error', 'An error occurred while updating the court. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $court = Court::find($id);

        $court->delete();

        return redirect()->route('courts.index')->with('success', 'Court Deleted');
    }
}
