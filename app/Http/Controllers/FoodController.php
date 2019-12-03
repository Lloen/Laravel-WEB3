<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FoodController extends Controller
{
    //
    public function getIndex()
    {
        $foods = DB::table('foods')->get();

        return view('food', ['foods' => $foods]);
    }

    
}