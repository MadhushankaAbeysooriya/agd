<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\SearchDetail;
use App\Models\DemandFromLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    /*public function searchdetail(Request $request)
    {
        $reply = 0;
        $message ='';

        $user = User::find(Auth::user()->id);

        if($user->search_count >= 20 && Auth::user()->can('search-details'))
        {
            //dd('in if');
            $message = "You have exceeded search per day";

            SearchDetail::create([
                'nic' => $request->search,
                'user_id' => Auth::user()->id,
                'reply' => $reply,
            ]);

            $searchDetails = SearchDetail::where('user_id', Auth::user()->id)
                        ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                        ->get();

            $user->update(['search_count' => $user->search_count++]);

            return view('home', compact('message','reply','searchDetails'));
        }
        elseif($user->search_count >= 5)
        {
            //dd('if else in');
            $message = "You have exceeded search per day";

            SearchDetail::create([
                'nic' => $request->search,
                'user_id' => Auth::user()->id,
                'reply' => $reply,
            ]);

            $searchDetails = SearchDetail::where('user_id', Auth::user()->id)
                        ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                        ->get();

            $user->update(['search_count' => $user->search_count++]);

            return view('home', compact('message','reply','searchDetails'));

        }else
        {
            //dd('in else');
            $user->update(['search_count' => $user->search_count++]);

            // Check if the user has a valid access token in the session
            $currentAccessToken = Session::get('access_token');

            if (!$currentAccessToken) {
                // No access token in the session or it has expired, obtain a new one
                $currentAccessToken = $this->getToken();

                if ($currentAccessToken) {
                    // Store the new access token in the session
                    Session::put('access_token', $currentAccessToken);
                } else {
                    // Handle the case where obtaining a new token failed
                    return response()->json(['error' => 'Failed to obtain a valid access token'], 500);
                }
            }

            //$currentAccessToken = $this->refreshAccessToken($currentAccessToken);


            // Now that you have a valid access token, perform the search
            $responseData = $this->search_person($currentAccessToken, $request->search);
            //dd($responseData);



            if(!empty($responseData) && $responseData !== "Null")
            {
                $reply = 1;
            }

            //dd($reply);
            $message = ($reply === 1) ? '<b> Military Personel </b>' : '<b> Search failed </b>';

            SearchDetail::create([
                'nic' => $request->search,
                'user_id' => Auth::user()->id,
                'reply' => $reply,
            ]);

            $searchDetails = SearchDetail::where('user_id', Auth::user()->id)
                        ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                        ->get();

            //$user = User::find(Auth::user()->id);

            $user->update(['search_count' => $user->search_count++]);

            return view('home', compact('message','reply','responseData','searchDetails'));
        }
    }*/

    // public function getToken()
    // {
    //     $url = 'https://armyapps.army.lk/ashi_api/api/login';

    //     // Define the query parameters (email and password)
    //     $params = [
    //         'email' => 'admin@gmail.com',
    //         'password' => 'Abcd@1234',
    //     ];

    //     try {
    //         // Send a GET request to the API
    //         $response = Http::post($url, $params);

    //         // Check if the response is successful (status code 200)
    //         if ($response->ok()) {
    //             // Parse the JSON response and extract the token
    //             //dd('in if');
    //             $data = $response->json();
    //             $token = $data['authorisation']['token'];

    //             // You can now use the token for further requests or return it as needed
    //             return response()->json(['token' => $token]);
    //         } else {
    //             //dd('in else');
    //             // Handle the case where the request was not successful
    //             return response()->json(['error' => 'API request failed'], $response->status());
    //         }
    //     } catch (\Exception $e) {
    //         // Handle any exceptions that may occur during the request
    //         return response()->json(['error' => $e->getMessage()], 500); // Internal Server Error
    //     }
    // }

    public function getToken()
    {
        //dd('in');
        $url = 'https://armyapps.army.lk/ashi_api/api/login';

        // Define the query parameters (email and password)
        $params = [
            'email' => 'admin@gmail.com',
            'password' => 'Abcd@1234',
        ];

        try {
            $client = new Client();

            // Send a POST request to the API
            $response = $client->post($url, [
                'json' => $params, // Send data as JSON
                'verify' => false,
            ]);

            // Check if the response is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Parse the JSON response and extract the token
                $data = json_decode($response->getBody(), true);
                $token = $data['authorisation']['token'];

                // You can now use the token for further requests or return it as needed
                return $token;
            } else {
                // Handle the case where the request was not successful
                return response()->json(['error' => 'API request failed'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the request
            return response()->json(['error' => $e->getMessage()], 500); // Internal Server Error
        }
    }



    public function refreshAccessToken($currentAccessToken)
    {
        $url = 'https://armyapps.army.lk/ashi_api/api/refresh';

        try {
            // Send a POST request to refresh the token
            // $response = Http::post($url, [
            //     'headers' => [
            //         'Authorization' => 'Bearer ' . $currentAccessToken,
            //     ],
            // ]);

            // dd($response);

            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $currentAccessToken,
                ],
                'verify' => false,

            ]);

            // Check if the response is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Parse the JSON response
                $data = json_decode($response->getBody(), true);

                // Extract the new access token
                $newAccessToken = $data['access_token'];

                return $newAccessToken;
            } else {
                // Handle the case where the request was not successful
                return response()->json(['error' => 'API request failed'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the request
            return response()->json(['error' => $e->getMessage()], 500); // Internal Server Error
        }
    }

    public function logout($currentAccessToken)
    {
        $url = 'https://armyapps.army.lk/ashi_api/api/logout';

        try {

            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $currentAccessToken,
                ],
                'verify' => false,
            ]);

            // Check if the response is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Parse the JSON response
                $data = json_decode($response->getBody(), true);

                // Extract the new access token
                $status = $data['status'];

                return $status;
            } else {
                // Handle the case where the request was not successful
                return response()->json(['error' => 'API request failed'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the request
            return response()->json(['error' => $e->getMessage()], 500); // Internal Server Error
        }
    }

    public function search_person($currentAccessToken, $nic)
    {
        $url = 'https://armyapps.army.lk/ashi_api/api/search_person';

        // Define the query parameters (email and password)
        $params = [
            'nic' => $nic
        ];

        try {

            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $currentAccessToken,
                ],
                'json' => $params,
                'verify' => false,
            ]);

            // Check if the response is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Parse the JSON response
                $data = json_decode($response->getBody(), true);

                // Extract the new access token
                // $status = $data['status'];
                $person = isset($data['person']) ? $data['person'] : null;

                return $person;
            } else {
                // Handle the case where the request was not successful
                return response()->json(['error' => 'API request failed'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the request
            return response()->json(['error' => $e->getMessage()], 500); // Internal Server Error
        }
    }

}
