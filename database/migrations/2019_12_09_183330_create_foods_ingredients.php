<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods_ingredients', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_ingredient');
            $table->unsignedBigInteger('fk_recipe');
            $table->double('amount', 10, 2);
        });
        
        
        Schema::table('foods_ingredients', function (Blueprint $table) {
            $table->foreign('fk_ingredient')->references('id')->on('ingredients');
            $table->foreign('fk_recipe')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods_ingredients', function (Blueprint $table) {
            //
        });
    }
}
