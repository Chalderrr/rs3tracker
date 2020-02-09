<?php

namespace App\Http\Controllers;


use RuneStat\RS3\API;
use Illuminate\Http\Request;


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

        dd($player);
        // response in console > message: "Player [test] has their profile set to private"

        return response()->json([$request->all()]);
    }

}
