<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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

            'unit' => $this->whenPivotLoaded('ingredient_recipe', function () {
                return $this->pivot->unit;
            }),
            'quantity' => $this->whenPivotLoaded('ingredient_recipe', function () {
                return $this->pivot->quantity;
            }),
        ];
    }
}
