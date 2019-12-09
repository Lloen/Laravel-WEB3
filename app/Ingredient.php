<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    public function foodIngredients()
    {
        return $this->hasMany('App\FoodIngredient');
    }
}