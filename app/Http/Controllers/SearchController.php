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
        return response()->json([$request->all()]);
    }

}
