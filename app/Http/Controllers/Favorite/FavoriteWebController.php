<?php

namespace App\Http\Controllers\Favorite;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $favorites = Favorite::paginate(10);

    //     foreach($favorites as $favorite) 
    //     {
    //         $mainservices = $favorite->mainservices;
    //         $category = $favorite->category;
    //         $buyers = $favorite->buyers;
    //     }
    //     // dd($favorites);
    //     return view('layouts.web.favorite.index')->with('favorites', $favorites);

    //     // return response()->json([
    //     //         'data' => $favorites,
    //     //     ]);
    // }
}
