<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CookingStep extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
