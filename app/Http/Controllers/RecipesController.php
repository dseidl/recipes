<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Http\Resources\RecipeResource;

class RecipesController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    public function index()
    {
        $searchString = request('query');

        $recipes = RecipeResource::collection(
            Recipe::query()
                  ->with('cookingSteps', 'ingredients')
                  ->when($searchString, function($query, $searchString) {
                      return $query->where('title', 'like', "%{$searchString}%");
                  })
                  ->paginate(40)
        );

        return $recipes;
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('cookingSteps', 'ingredients');

        return new RecipeResource($recipe);
    }
}
