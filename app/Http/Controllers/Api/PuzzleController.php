<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Puzzle_detail;
use App\Models\random_string;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PuzzleController extends Controller
{


    function list()
    {
        return view('list');
    }
    function checkWord()
    {

        try {
            $word = request('word');
            if ($word != '') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.dictionaryapi.dev/api/v2/entries/en/' . $word,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($response);
                if (isset($result->title)) {
                    $response = [
                        'status' => 201,
                        'message' => 'Invalid Word'
                    ];
                } else {
                    $response = [
                        'status' => 200,
                        'message' => 'Valid Word'
                    ];
                }
            } else {

                $response = [
                    'status' => 202,
                    'message' => 'Invalid Input'
                ];
            }

            return  response()->json($response);
        } catch (Exception $e) {
            Log::info($e);
            $response = [
                'status' => 203,
                'message' => 'Internal Error'
            ];

            return  response()->json($response);
        }
    }


    function puzzile_details_update()
    {
        try {
            $Words_list = request('Words_list');
            $score = request('score');

            if (isset($Words_list) && !empty($Words_list) && isset($score) && $score > 0) {
                $data_to_db = [
                    "user_id" => auth()->user()->id,
                    "score" => $score,
                    "rand_word_id" => 1,
                    "valid_words" => json_encode($Words_list)
                ];
                Puzzle_detail::create($data_to_db);
                $response = [
                    'status' => 200,
                    'message' => 'Succcessfuly inserted',
                ];
            } else {
                $response = [
                    'status' => 201,
                    'message' => 'Invalid Input'
                ];
            }
            return response()->json($response);
        } catch (Exception $e) {
            Log::info($e);
            $response = [
                'status' => 202,
                'message' => 'Internal error'
            ];
            return response()->json($response);
        }
    }
    function game_list()
    {
        $random_strings = random_string::all();
        return view('list', compact('random_strings'));
    }


    function puzzileScore()
    {
        $puzzile_details = Puzzle_detail::all();
        return view('game_score', compact('puzzile_details'));
    }
}
