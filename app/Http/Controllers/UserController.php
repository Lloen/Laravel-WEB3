<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user = User::find($id);
        $recipes = DB::table('recipes')->where('created_by', '=', $id)->get();

        // if($user->avatar == null) {
        //     $user->avatar = Storage::disk('local')->get('\images\User_Placeholder.png');
        // }

        // $img = Image::make(Storage::disk('local')->get('\images\User_Placeholder.png'));
        // $img->resize(100, 100);
        
        // $user->avatar = $img;
       
        return view('profiles.show', compact('user', 'recipes'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|'.Rule::unique('users')->ignore($user->id),
            //'avatar' => 'sometimes'|'image'|'mimes:jpg,jpeg,bmp,svg,png'|'max:2000'
        ]);

        $user->name = $request->name;

        $user->save();

        return redirect('/profile/'.$userId)->with('success', 'Data has been updated!');
    }
}
