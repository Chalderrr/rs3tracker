<?php

namespace App\Http\Controllers;


use RuneStat\RS3\API;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;


class SearchController extends Controller {

    public function home()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string'
        ]);
        $result = $request->input('search');

        $rs3api = new API();

        $player = $rs3api->getProfile($result);
        $stats = $player->getStats();
        $combat = $player->getCombatLevel();
        $activities = $player->getActivities();
        $total = $stats->getTotalLevel();

        $activitiesArray = [];
        foreach($activities->getActivities() as $activity) {
            $activitiesArray[] = [
                'date' => $activity->getDate(),
                'text' => $activity->getText(),
                'details' => $activity->getDetails()
            ];
        }

        // dd($activities->getActivities());

        $skillsArray = [];
        foreach($stats as $skill) {           
            $skillsArray[] = [
                'name' => $skill->getSkill()->getName(),
                'level' => $skill->getLevel(),
                'virtualLevel' => $skill->getVirtualLevel(),
            ];
        }

        // dd($skill->getLevel());

        // try {
        //     $player = $rs3api->getProfile($result);
        // } catch (RequestException $e) {

        // };


        $response = [
            'activites' => $activitiesArray,
            'skills' => $skillsArray,
            'combat' => $combat,
            'totalLevel' => $stats->getTotalLevel(),
            'rank' => $stats->getRank(),
            'totalxp' => $stats->getTotalExperience(),
        ];

        //progress 1
        // response in console > message: "Player [test] has their profile set to private"
        //https://gyazo.com/95a1025d4581d81bf9d5617d8dc33550
        // include screenshot of progression with $player dumped into console.


        // progress 2
        //https://gyazo.com/c12c3388e0a4e898414aa0e910707457
        // Look more into the api and methods used to publicise private variables, use methods to get required data from $player
        // Tweak response into array, pass specific date to array response instead of ->all()

        // progress 3
        //https://gyazo.com/92c44c4aab87bab73323bb8b48b7904e
        // Look further into the api see what different data points are available, start defining more data points and passing them into the $response array to 
        // be used inside the vue component

        return response()->json($response);
    }

}
