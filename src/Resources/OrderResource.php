<?php

namespace Cone\Bazar\Resources;

use Cone\Bazar\Fields\Products;
use Cone\Bazar\Models\Shipping;
use Cone\Bazar\Shipping\Driver;
use Cone\Bazar\Support\Facades\Shipping as ShippingManager;
use Cone\Root\Fields\BelongsTo;
use Cone\Root\Fields\Date;
use Cone\Root\Fields\HasOne;
use Cone\Root\Fields\ID;
use Cone\Root\Fields\Number;
use Cone\Root\Fields\Select;
use Cone\Root\Fields\Text;
use Cone\Root\Http\Requests\RootRequest;
use Cone\Root\Resources\Resource;
use Illuminate\Support\Str;

class OrderResource extends Resource
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected array $with = [
        'items',
        'shipping',
        'transactions',
    ];

    /**
     * Define the fields for the resource.
     *
     * @param  \Cone\Root\Http\Requests\RootRequest  $request
     * @return array
     */
    public function fields(RootRequest $request): array
    {
        return array_merge(parent::fields($request), [
            ID::make(),

            Text::make(__('Total'), 'formatted_total')
                ->visibleOnDisplay(),

            Date::make(__('Created at'), 'created_at')
                ->visibleOnDisplay(),

            BelongsTo::make(__('Customer'), 'user')
                ->nullable()
                ->async()
                ->display('name'),

            HasOne::make(__('Shipping'), 'shipping')
                ->asSubResource()
                ->display('driver_name'),

            Products::make(__('Products'), 'items')
                ->asSubResource()
                ->hiddenOnIndex()
                ->display('name'),
        ]);
    }
}
