<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();

        return view('profiles.index', compact('users'));
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
        $this->authorize('update', $user);

        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        if (request()->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $id . '-' . time() . '.' . request()->avatar->getClientOriginalExtension();
            $img = Image::make($avatar)->resize(300, 300);
            $img->save(storage_path('app/public/images/users/' . $avatarName));

            $user->avatar = $avatarName;
        }

        if(Gate::allows('is-admin') && request()->has('is_admin'))
            $user->is_admin = $request->is_admin;

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect('/profile/' . $id)->with('success', 'Profile has been updated!');
    }

    /**
     * Download the recipe as Excel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $this->authorize('viewAny', User::class);

        return Excel::download(new UsersExport, 'users.xlsx');
    }
}

class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
