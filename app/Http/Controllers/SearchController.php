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

        

        try {
            $player = $rs3api->getProfile($result);
        } catch (RequestException $e) {

        };

        dd($player);
        // response in console > message: "Player [test] has their profile set to private"
        //https://gyazo.com/95a1025d4581d81bf9d5617d8dc33550
        // include screenshot of progression with $player dumped into console.

        return response()->json([$request->all()]);
    }

}
