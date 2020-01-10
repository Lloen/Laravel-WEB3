<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
class ApiController extends Controller
{
    public function getAllIngredients() {
        $ingredients = Ingredient::get();
        foreach($ingredients as $ingredient){
            $ingredient->picture = base64_encode($ingredient->picture);
        }
        $ingredients->toJson(JSON_PRETTY_PRINT);
        return response($ingredients, 200);
    }
  
    public function createIngredient(Request $request) {
        $ingredient = new Ingredient;
        $ingredient->name = $request->name;
        $ingredient->description = $request->description;
        $ingredient->wikipedia_id = $request->wikipedia_id;
        $ingredient->name_scientific = $request->name_scientific;
        $ingredient->group = $request->group;
        $ingredient->updated_by = $request->updated_by;
        $ingredient->created_by = $request->created_by;
        $ingredient->save();

        return response()->json(["message" => "Ingredient record created"], 201);
    }
  
      public function getIngredient($id) {
        if (Ingredient::where('id', $id)->exists()) {
            $ingredient = Ingredient::find($id);
            $ingredient->picture = base64_encode($ingredient->picture);
            $ingredient->toJson(JSON_PRETTY_PRINT);
            return response($ingredient, 200);
        } 
        else {
            return response()->json([
              "message" => "Ingredient not found"
            ], 404);
        }
    }
  
      public function updateIngredient(Request $request, $id) {
        // logic to update a student record goes here
    }
  
      public function deleteIngredient ($id) {
        // logic to delete a student record goes here
    }
}
