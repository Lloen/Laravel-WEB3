<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use Illuminate\Support\Facades\Auth;

class IngredientApiController extends Controller
{
  public function getAllIngredients()
  {
    $ingredients = Ingredient::select('id', 'name', 'wikipedia_id', 'group', 'name_scientific')->get();
    foreach ($ingredients as $ingredient) {
      $ingredient->picture = base64_encode($ingredient->picture);
    }
    $ingredients->toJson(JSON_PRETTY_PRINT);
    return response($ingredients, 200);
  }

  public function getIngredient($id)
  {
    if (Ingredient::where('id', $id)->exists()) {
      $ingredient = Ingredient::find($id);
      $ingredient->picture = base64_encode($ingredient->picture);
      $ingredient->toJson(JSON_PRETTY_PRINT);
      return response($ingredient, 200);
    } else {
      return response()->json([
        "message" => "Ingredient not found"
      ], 404);
    }
  }

  public function updateIngredient(Request $request, $id)
  {
    if (Ingredient::where('id', $id)->exists()) {

        $request->validate([
          'name' => 'required|max:255',
          'description' => 'required',
          'wikipedia_id' => 'sometimes|max:255',
          'name_scientific' => 'sometimes|max:255',
          'group' => 'required|max:255'
      ]);

      $ingredient = Ingredient::find($id);

      $ingredient->name = $request->name;
      $ingredient->description = $request->description;
      $ingredient->wikipedia_id = basename($request->wikipedia_id);
      $ingredient->name_scientific = $request->name_scientific;
      $ingredient->group = $request->group;

      $ingredient->save();

      return response()->json(["message" => "Record updated successfully"], 200);
    } else {
      return response()->json(["message" => "Ingredient not found"], 404);
    }
  }

  public function createIngredient(Request $request)
  {
    $request->validate([
      'name' => 'required|max:35',
      'description' => 'required|max:255',
      'group' => 'required',
      //'picture' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048'
    ]);

    $ingredient = new Ingredient([
      'name' => $request->get('name'),
      'description' => $request->get('description'),
      'wikipedia_id' => basename($request->get('wikipedia_id')),
      'name_scientific' => $request->get('name_scientific'),
      'group' => $request->get('group')
    ]);

    $ingredient->save();

    return response()->json(["message" => "Ingredient record created"], 201);
  }

  public function deleteIngredient($id)
  {
    if (Ingredient::where('id', $id)->exists()) {
      $ingredient = Ingredient::find($id);
      $ingredient->delete();
      return response()->json(["message" => "record deleted"], 202);
    } else {
      return response()->json(["message" => "Ingredient not found"], 404);
    }
  }
}
