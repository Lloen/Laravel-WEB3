<?php

namespace App\Http\Controllers;

use App\FoodsIngredient;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Recipe;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;


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
        $ingredients = Ingredient::select('id', 'name')->orderBy('name', 'ASC')->get();

        return view('recipes.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:35',
            'description' => 'required|max:255',
            'prep_time' => 'required',
            'cook_time' => 'required',
            'ingredients' => 'required',
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $recipe = new Recipe([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'prep_time' => $request->get('prep_time'),
            'cook_time' => $request->get('cook_time'),
            'votes' => "0",
            'created_by' => Auth::user()->id
        ]);

        if(request()->has('picture')) {
            $picture = $request->file('picture');
            $pictureName = time().'.'.request()->picture->getClientOriginalExtension();
            $img = Image::make($picture)->resize(715, 479);
            $watermark = Image::make(storage_path('app/public/images/recipes/Recipe_Watermark.png'));
            $img->insert($watermark, 'bottom-right', 10, 10);
            $img->save(storage_path('app/public/images/recipes/' . $pictureName));

            $recipe->picture = $pictureName;
        }

        $recipe->save();
       
        foreach(json_decode($request->get('ingredients')) as $ingredient) {
            $recipe->ingredients()->attach($ingredient->id, ['amount' => $ingredient->amount, 'unit' => $ingredient->unit]);
        }

        return route('recipes.show', ['recipe' => $recipe]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $this->authorize('update', $recipe);

        $ingredients = Ingredient::select('id', 'name')->orderBy('name', 'ASC')->get();
        
        return view('recipes.edit', compact('recipe', 'ingredients'));
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
        $recipe = Recipe::find($id);
        $this->authorize('update', $recipe);
        
        $request->validate([
            'name' => 'required|max:35',
            'description' => 'required|max:255',
            'prep_time' => 'required',
            'cook_time' => 'required',
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->cook_time = $request->cook_time;
        
        if(request()->has('picture')) {
            $picture = $request->file('picture');
            $pictureName = time().'.'.request()->picture->getClientOriginalExtension();
            $img = Image::make($picture)->resize(715, 479);
            $watermark = Image::make(storage_path('app/public/images/recipes/Recipe_Watermark.png'));
            $img->insert($watermark, 'bottom-right', 10, 10);
            $img->save(storage_path('app/public/images/recipes/' . $pictureName));
            $recipe->picture = $pictureName;
        }

        foreach(json_decode($request->get('ingredients')) as $ingredient) {
            $recipe->ingredients()->sync([$ingredient->id => ['amount' => $ingredient->amount, 'unit' => $ingredient->unit]]);
        }

        $recipe->save();

        return route('recipes.show', ['recipe' => $recipe]);
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $recipe = Recipe::find($id);
        $recipe->ingredients()->detach();
        $this->authorize('delete', $recipe);

        return view('recipes.delete', compact('recipe'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();

        return redirect('/profile/'.$recipe->created_by)->with('success', 'Recipe has been deleted!');
    }

    /**
     * Download the recipe as PDF.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $recipe = Recipe::find($id);

        $pdf = PDF::loadView('recipes.download', compact('recipe'));
        return $pdf->download($recipe->name.'.pdf');
    }
}
