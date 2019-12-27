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
            //'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        if(request()->has('avatar')) {
            $avatarName = $userId.'-'.time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('/images/users', $avatarName);

            $user->avatar = $avatarName;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect('/profile/'.$userId)->with('success', 'Profile has been updated!');
    }
}
