<?php

namespace App\Console\Commands;

use App\Recipe;
use App\Ingredient;
use App\CookingStep;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportCookbook extends Command
{
    protected $signature = 'import:cookbook';
    protected $description = 'Import initial recipes from cookbook';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $recipes = collect(json_decode(Storage::disk('local')->get('recipesById.json')));

        $bar = $this->output->createProgressBar(count($recipes));

        $recipes->each(function ($recipe) use ($bar) {
            $newRecipe = Recipe::updateOrCreate(
                [
                    'source' => 'cookbook',
                    'import_id' => $recipe->id,
                ],
                [
                    'title' => $recipe->name,
                    'description' => $recipe->description,
                    'carbonhydrate' => $recipe->carbonhydrate,
                    'protein' => $recipe->protein,
                    'fat' => $recipe->fat,
                    'energy_value' => $recipe->energyValue,
                    'is_gluten_free' => $recipe->isGlutenFree,
                    'is_lactose_free' => $recipe->isLactoseFree,
                    'is_vegetarian' => $recipe->isVegetarian || $recipe->isVeggie,
                    'is_meat' => $recipe->isMeat,
                    'is_fish' => $recipe->isFish,
                    'is_vegan' => $recipe->isVegan,
                    'should_have_at_home' => $recipe->shouldHaveAtHome,
                    'cooking_advice' => $recipe->cookingAdvice,
                ]
            );

            $cookingSteps = collect($recipe->cookingSteps)->map(function ($step) {
                return CookingStep::updateOrCreate([
                    'description' => $step->description,
                    'step' => $step->step,
                ]);
            });
            $newRecipe->cookingSteps()->saveMany($cookingSteps);

            $ingredients = collect($recipe->ingredients)
                ->filter(function ($ingredient) {
                    return $ingredient->nrOfPersons === '2';
                })
                ->mapWithKeys(function ($ingredient) {
                    $newIngredient = Ingredient::updateOrCreate([
                        'title' => $ingredient->name,
                    ]);

                    return [
                        $newIngredient->fresh()->id => [
                            'unit' => $ingredient->unit,
                            'quantity' => $ingredient->quantity,
                        ],
                    ];
                });

            $newRecipe->ingredients()->sync($ingredients->toArray());

            $bar->advance();
        });

        $bar->finish();
    }
}
