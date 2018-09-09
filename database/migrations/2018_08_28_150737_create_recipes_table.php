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
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('carbonhydrate')->default(0);
            $table->integer('protein')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('energy_value')->default(0);
            $table->boolean('is_gluten_free')->default(false);
            $table->boolean('is_lactose_free')->default(false);
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_meat')->default(false);
            $table->boolean('is_fish')->default(false);
            $table->boolean('is_vegan')->default(false);
            $table->mediumText('should_have_at_home')->nullable();
            $table->longText('cooking_advice')->nullable();
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
