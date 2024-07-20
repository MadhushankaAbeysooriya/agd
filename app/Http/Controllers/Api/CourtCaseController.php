<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\master\CourtCase;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CourtCaseController extends Controller
{
    public function getAll()
    {
        try {

            /*$courtcase = CourtCase::select('id',
                                            'case_no',
                                            'case_file_no',
                                            'title',
                                            'client_name',
                                            'started_date',
                                            'closed_date')->with('court')->get();*/

            $courtcases = CourtCase::all();

            $transformedData = $courtcases->map(function ($courtcase) {
                // Get the latest CaseStatus for this CourtCase
                $latestCaseStatus = $courtcase->casestatuses()->latest()->first();
                    return [
                        'id' => $courtcase->id,
                        'case_no' => $courtcase->case_no,
                        'case_file_no' => $courtcase->case_file_no,
                        'title' => $courtcase->title,
                        'client_name' => $courtcase->client_name,
                        'started_date' => $courtcase->started_date,
                        'closed_date' => $courtcase->closed_date,
                        'court' => $courtcase->court->name,
                        'latest_status' => $latestCaseStatus ? $latestCaseStatus->status : null,
                    ];
            });

            return response()->json(['courtcases' => $transformedData],200);

        } catch (Exception $e) {

            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function getCourtCaseDetail(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'court_case_id' => 'required|exists:court_cases,id',
        ], [
            'court_case_id.required' => 'The court case id field is required.',
            'court_case_id.exists' => 'The selected court case id is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 0], 200);
        }

        try {

            // Fetch the CourtCase by ID
            $courtcase = CourtCase::findOrFail($request->input('court_case_id'));

            // Get the latest CaseNxtHearDate for this CourtCase
            $latestCaseNxtHearDate = $courtcase->casenxtneardates()->latest()->first();

            // Get the latest User for this CourtCase
            $latestUser = $courtcase->users()->latest()->first();

            // Get the latest CaseStatus for this CourtCase
            $latestCaseStatus = $courtcase->casestatuses()->latest()->first();

            // Get the court case categories for this CourtCase
            $caseCategories = $courtcase->casecategories()->pluck('name');

            // Transform the data
            $transformedData = [
                'id' => $courtcase->id,
                'case_no' => $courtcase->case_no,
                'case_file_no' => $courtcase->case_file_no,
                'title' => $courtcase->title,
                'client_name' => $courtcase->client_name,
                'started_date' => $courtcase->started_date,
                'closed_date' => $courtcase->closed_date,
                'court' => $courtcase->court->name,
                'latest_case_nxt_hear_date' => $latestCaseNxtHearDate ? $latestCaseNxtHearDate->nxt_hear_date : null,
                'latest_user' => $latestUser ? $latestUser->fname : null,
                'latest_status' => $latestCaseStatus ? $latestCaseStatus->status : null,
                'categories' => $caseCategories,
            ];

            // Return the response as JSON
            return response()->json(['court_case' => $transformedData], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function getCourtCaseByUser(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'The court case id field is required.',
            'user_id.exists' => 'The selected court case id is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 0], 200);
        }

        //try {

            // Fetch the User by ID
            $user = User::findOrFail($request->input('user_id'));

            $courtcases = $user->courtcases;

            // Transform the data
            $transformedData = $courtcases->map(function ($courtcase) {
                // Get the latest CaseStatus for this CourtCase
                $latestCaseStatus = $courtcase->casestatuses()->latest()->first();

                // Get the latest CaseNxtHearDate for this CourtCase
                $latestCaseNxtHearDate = $courtcase->casenxtneardates()->latest()->first();
                    return [
                        'id' => $courtcase->id,
                        'case_no' => $courtcase->case_no,
                        'case_file_no' => $courtcase->case_file_no,
                        'title' => $courtcase->title,
                        'client_name' => $courtcase->client_name,
                        'started_date' => $courtcase->started_date,
                        'closed_date' => $courtcase->closed_date,
                        'court' => $courtcase->court->name,
                        'latest_status' => $latestCaseStatus ? $latestCaseStatus->status : null,
                        'latest_case_nxt_hear_date' => $latestCaseNxtHearDate ? $latestCaseNxtHearDate->nxt_hear_date : null,
                    ];
            });

            // Return the response as JSON
            return response()->json(['court_case' => $transformedData], 200);

        /*} catch (Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }*/
    }
}
