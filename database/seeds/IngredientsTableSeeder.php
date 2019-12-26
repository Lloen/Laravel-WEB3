<?php

use App\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = Storage::disk('local')->get('ingredients.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $url = 'http://foodb.ca/system/foods/pictures/'.$obj->id.'/full/'.$obj->id.'.png';
            $headers = get_headers($url);

            if(strpos($headers[0],'200'))
            {
                $imgUrl = file_get_contents($url);
                $img = (string) Image::make($imgUrl)->encode('jpg', 75);
            }
            else
                $img = Storage::disk('local')->get('\images\Ingredient_Placeholder.png');

            Ingredient::create(array(
                'name' => $obj->name,
                'description' => $obj->description,
                'wikipedia_id' => $obj->wikipedia_id,
                'name_scientific' => $obj->name_scientific,
                'group' => $obj->food_group,
                'picture' => $img,
                'created_by' => 1
            ));
        }
    }
}
