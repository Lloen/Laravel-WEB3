<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $recipes = DB::table('recipes')->where('created_by', '=', $id)->get();

        return view('profiles.show', compact('user', 'recipes'));
    }
}
