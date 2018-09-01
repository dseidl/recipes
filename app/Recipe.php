<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cookingSteps()
    {
        return $this->hasMany(CookingStep::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('unit', 'quantity');
    }
}
