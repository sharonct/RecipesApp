<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $s=$request->input('s');
        $searches = Search::latest()
            ->search
            ->paginate(5);

        return view('posts.index',compact('searches','s'));
    }
}
