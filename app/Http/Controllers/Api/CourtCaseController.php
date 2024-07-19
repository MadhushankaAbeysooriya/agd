<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\master\CourtCase;
use App\Http\Controllers\Controller;

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
                                                return [
                                                    'id' => $courtcase->id,
                                                    'case_no' => $courtcase->case_no,
                                                    'case_file_no' => $courtcase->case_file_no,
                                                    'title' => $courtcase->title,
                                                    'client_name' => $courtcase->client_name,
                                                    'started_date' => $courtcase->started_date,
                                                    'closed_date' => $courtcase->closed_date,
                                                    'court' => $courtcase->court->name,
                                                ];
                                            });

            return response()->json(['courtcases' => $transformedData],200);

        } catch (Exception $e) {

            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
}
