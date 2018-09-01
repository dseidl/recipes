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
            'name' => $this->name,
            'description' => $this->description,
            'carbonhydrate' => $this->carbonhydrate,
            'protein' => $this->protein,
            'fat' => $this->fat,
            'energyValue' => $this->energyValue,
            'isGlutenFree' => $this->isGlutenFree,
            'isLactoseFree' => $this->isLactoseFree,
            'isVegetarian' => $this->isVegetarian,
            'isMeat' => $this->isMeat,
            'isFish' => $this->isFish,
            'isVegan' => $this->isVegan,
            'shouldHaveAtHome' => $this->shouldHaveAtHome,
            'cookingAdvice' => $this->cookingAdvice,
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
            'cookingSteps' => CookingStepResource::collection($this->whenLoaded('cookingSteps')),
        ];
    }
}
