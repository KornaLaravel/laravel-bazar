<?php

namespace Cone\Bazar\Fields;

use Cone\Root\Fields\Json;
use Cone\Root\Fields\Number;
use Cone\Root\Http\Requests\RootRequest;

class Prices extends Json
{
    /**
     * {@inheritdoc}
     */
    public function fields(RootRequest $request): array
    {
        return array_merge(parent::fields($request), [
            Number::make($this->label, 'default')
                ->min(0)
                ->step(0.1),

            Number::make(sprintf('%s %s', __('Sale'), $this->label), 'sale')
                ->min(0)
                ->step(0.1),
        ]);
    }
}
