<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    use SearchesRelations;

    public static $searchRelations = [
        'customer' => ['name', 'surname'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsToMany::make('Services', 'services', Service::class)->fields(function () {
                return [
                    Number::make('Totale', 'total'),
                    Number::make('VAT', 'vat'),
                    Number::make('Quantity', 'quantity'),
                ];
            })->display(function ($customer) {
                return $customer->id . ' ' . $customer->title;

            }),
            BelongsTo::make('Customer', 'customer', Customer::class)->display(function ($service) {
                return $service->id . ' ' . $service->title;

            })->displayUsing(function($customer){
                return $customer->name;
            }),
            DateTime::make('Date', 'date'),
            Select::make('Status', 'status')->
            options([
                'P' => 'Pending',
                'D' => 'In Progress',
                'R' => 'Rejected',
                'C' => 'Completed',
                'W' => 'Waiting for client review',
            ])->displayUsingLabels(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
