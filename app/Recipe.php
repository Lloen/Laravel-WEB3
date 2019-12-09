<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //

    public function foodIngredients()
    {
        return $this->hasMany('App\FoodIngredient');
    }
}
