<?php

namespace App\Http\Controllers;

use App\FoodsIngredient;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $ingredients = Ingredient::select('id', 'name')->get();

            return view('recipes.create', compact('ingredients'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'prep_time' => 'required',
                'cook_time' => 'required',
                'ingredients' => 'required'
            ]);

            $recipe = new Recipe([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'prep_time' => $request->get('prep_time'),
                'cook_time' => $request->get('cook_time'),
                'votes' => "0",
                'created_by' => Auth::user()->id
            ]);

            $recipe->save();
           
            foreach(json_decode($request->get('ingredients')) as $ingredient) {
                $foodIngredient = new FoodsIngredient([
                    'fk_ingredient' => $ingredient->id,
                    'fk_recipe' => $recipe->id,
                    'amount' => $ingredient->amount,
                    'unit' => $ingredient->unit
                ]);

                $foodIngredient->save();
            }

            return redirect('/recipes')->with('success', 'Recipe has been added!');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $recipeData = FoodsIngredient::with(['recipe','ingredient'])->where('fk_recipe', $id)->get();
            $recipe = Recipe::find($id);

            return view('recipes.show', compact('recipeData', 'recipe'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $recipe = Recipe::find($id);

            return view('recipes.edit', compact('recipe'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'prep_time' => 'required',
                'cook_time' => 'required'
            ]);

            $recipe = Recipe::find($id);

            $this->authorize('update', $recipe);


            $recipe->name = $request->name;
            $recipe->description = $request->description;
            $recipe->prep_time = $request->prep_time;
            $recipe->cook_time = $request->cook_time;

            $recipe->save();

            return redirect('/recipes')->with('success', 'Recipe has been updated!');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Auth::check()) {
            $recipe = Recipe::find($id);
            $this->authorize('delete', $recipe);

            return view('recipes.delete', compact('recipe'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $recipe = Recipe::find($id);
            $recipe->delete();

            return redirect('/recipes')->with('success', 'Recipe has been deleted!');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
