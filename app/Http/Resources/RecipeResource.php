<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'carbonhydrate' => $this->carbonhydrate,
            'protein' => $this->protein,
            'fat' => $this->fat,
            'energyValue' => $this->energy_value,
            'isGlutenFree' => $this->is_gluten_free,
            'isLactoseFree' => $this->is_lactose_free,
            'isVegetarian' => $this->is_vegetarian,
            'isMeat' => $this->is_meat,
            'isFish' => $this->is_fish,
            'isVegan' => $this->is_vegan,
            'shouldHaveAtHome' => $this->should_have_at_home,
            'cookingAdvice' => $this->cooking_advice,
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
            'cookingSteps' => CookingStepResource::collection($this->whenLoaded('cookingSteps')),
        ];
    }
}
