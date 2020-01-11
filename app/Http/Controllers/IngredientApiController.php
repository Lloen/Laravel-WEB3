<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
class IngredientApiController extends Controller
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
              "message" => "Ingredient not found"], 404);
        }
    }
  
    public function updateIngredient(Request $request, $id) {
        if (Ingredient::where('id', $id)->exists()) {
          $ingredient = Ingredient::find($id);
          $ingredient->name = is_null($request->name) ? $ingredient->name : $request->name;
          $ingredient->description = is_null($request->course) ? $ingredient->course : $request->course;
          $ingredient->wikipedia_id = is_null($request->wikipedia_id) ? $ingredient->wikipedia_id : $request->wikipedia_id;
          $ingredient->name_scientific = is_null($request->name_scientific) ? $ingredient->name_scientific : $request->name_scientific;
          $ingredient->group = is_null($request->group) ? $ingredient->group : $request->group;
          $ingredient->save();
  
          return response()->json(["message" => "Record updated successfully"], 200);
        } 
        else {
          return response()->json(["message" => "Ingredient not found"], 404);
        }
    }
  


    public function deleteIngredient ($id) {
      if(Ingredient::where('id', $id)->exists()) {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return response()->json(["message" => "record deleted"], 202);
      } 

      else {
        return response()->json(["message" => "Ingredient not found"], 404);
      }

    }
}
