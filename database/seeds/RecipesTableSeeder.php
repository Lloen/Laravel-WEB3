<?php

use App\Recipe;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::create(array(
            'name' => 'Cucumber water',
            'description' => 'Fresh water for cucumber lovers',
            'prep_time' => '1',
            'cook_time' => '30',
            'created_by' => '1'
        ));
    }
}
