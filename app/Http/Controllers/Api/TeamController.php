<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\master\Team;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function getAll()
    {
        try {

            $teams = Team::select('id','name','description')->get();

            return response()->json(['teams' => $teams],200);

        } catch (Exception $e) {

            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function getTeamMembers(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user id is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 0], 200);
        }

        try {
            // Find the user
            $user = User::findOrFail($request->input('user_id'));

            // Get all team IDs the user is part of
            $teamIds = $user->teams->pluck('id');

            // Get all other users in these teams, excluding the current user
            $teammembers = User::whereIn('id', function ($query) use ($teamIds) {
                $query->select('user_id')
                    ->from('user_teams')
                    ->whereIn('team_id', $teamIds);
            })->where('id', '!=', $user->id)
            ->distinct()
            ->get(['id', 'fname', 'lname']);

            return response()->json(['teammembers' => $teammembers], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function getUserDetail(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user id is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status' => 0], 200);
        }

        try {
            // Find the user
            $user = User::findOrFail($request->input('user_id'));


            return response()->json(['user' => $user], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
}
