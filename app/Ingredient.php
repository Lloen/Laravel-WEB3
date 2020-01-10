<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'description',
        'wkipedia_id',
        'name_scientific',
        'group',
        'updated_by',
        'created_by'
    ];
}
