<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 35);
            $table->string('description', 255);
            $table->integer('prep_time');
            $table->integer('cook_time');
            $table->bigInteger('votes')->default(0);
            $table->string('picture')->default('Recipe_Placeholder.png');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });

        Schema::table('recipes', function(Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
