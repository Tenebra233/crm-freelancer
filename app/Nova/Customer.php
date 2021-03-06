<?php

namespace App\Nova;

use App\Nova\Actions\SendEmailAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use KirschbaumDevelopment\NovaMail\Actions\SendMail;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Customer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Customer::class;

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
            BelongsTo::make('User', 'user', User::class)->canSee(function ($request) {
                return Gate::any('root');
            }),
            Text::make('Name', 'name'),
            Text::make('Surname', 'surname'),
            Number::make('Phone', 'phone_number'),
            Text::make('Email', 'email'),
            Date::make('Birth', 'birth'),
            Text::make('Country', 'country'),
            Text::make('State', 'state'),
            Text::make('City', 'city'),
            Text::make('Address', 'address'),
            Text::make('Second address', 'second_address')->nullable(true),
            Number::make('Postal code', 'postal_code'),
            HasMany::make('Order', 'order', Order::class)->canSee(function ($request) {
                return Gate::any('root');
            }),
            HasMany::make('Appointments', 'appointment', Appointment::class)->canSee(function ($request) {
                return Gate::any('root');
            }),
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
        return [
            new SendEmailAction
        ];
    }
}
