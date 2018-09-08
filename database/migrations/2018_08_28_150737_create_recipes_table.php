<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('carbonhydrate')->default(0);
            $table->integer('protein')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('energyValue')->default(0);
            $table->boolean('isGlutenFree')->default(false);
            $table->boolean('isLactoseFree')->default(false);
            $table->boolean('isVegetarian')->default(false);
            $table->boolean('isMeat')->default(false);
            $table->boolean('isFish')->default(false);
            $table->boolean('isVegan')->default(false);
            $table->mediumText('shouldHaveAtHome')->nullable();
            $table->longText('cookingAdvice')->nullable();
            $table->string('source')->nullable();
            $table->integer('import_id')->nullable();
            $table->timestamps();
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
