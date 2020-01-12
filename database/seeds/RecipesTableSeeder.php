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
            'description' => 'Fresh water for cucumber lovers.',
            'prep_time' => '1',
            'cook_time' => '30',
            'created_by' => '1'
        ));

        Recipe::create(array(
            'name' => 'Baked sweet potato',
            'description' => 'If you like potatos and you like sweet, you will love this recipe.',
            'prep_time' => '1',
            'cook_time' => '30',
            'created_by' => '2'
        ));
    }
}
