<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use App\Http\Resources\RecipeResource;

class RecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $recipes = RecipeResource::collection(
            Recipe::query()
                  ->with('cookingSteps', 'ingredients')
                  ->latest()
                  ->paginate(10)
        );

        return $recipes;
    }
}
