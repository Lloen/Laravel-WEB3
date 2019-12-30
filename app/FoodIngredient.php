<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodIngredient extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fk_ingredient',
        'fk_recipe',
        'amount',
        'unit'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }
}
