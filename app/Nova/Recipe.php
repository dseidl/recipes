<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;

class Recipe extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Recipe::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Image')->disk('public'),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Description'),

            new Panel('Meta Information', $this->metaFields()),
        ];
    }

    public function metaFields()
    {
        return [
            Number::make('Carbonhydrate')->hideFromIndex(),
            Number::make('Protein')->hideFromIndex(),
            Number::make('Fat')->hideFromIndex(),
            Number::make('Energy Value')->hideFromIndex(),

            Boolean::make('is Vegetarian')->sortable(),
            Boolean::make('is Meat')->sortable(),
            Boolean::make('is Fish')->sortable(),
            Boolean::make('is Vegan')->sortable(),
            Boolean::make('is Gluten free')->sortable(),
            Boolean::make('is Lactose free')->sortable(),

            Text::make('should have at home')
                ->rules('nullable', 'max:255')
                ->hideFromIndex(),

            Textarea::make('cooking advice'),

            HasMany::make('cookingSteps'),

            BelongsToMany::make('Ingredients')
                 ->fields(function () {
                     return [
                         Text::make('Unit'),
                         Text::make('Quantity'),
                     ];
                 })
                 ->searchable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
