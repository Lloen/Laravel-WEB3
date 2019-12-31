<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'prep_time',
        'cook_time',
        'votes',
        'created_by',
        'picture'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('ingredient_id', 'amount', 'unit');
    }
}
