<?php

namespace Cone\Bazar\Traits;

use Cone\Bazar\Support\Facades\Discount;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait InteractsWithDiscounts
{
    /**
     * Get the formatted discount attribute.
     */
    protected function formattedDiscount(): Attribute
    {
        return new Attribute(
            get: function (): string {
                return $this->getFormattedDiscount();
            }
        );
    }

    /**
     * Get the discount.
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Get the formatted discount.
     */
    public function getFormattedDiscount(): string
    {
        return Str::currency($this->getDiscount(), $this->currency);
    }

    /**
     * Calculate the discount.
     */
    public function calculateDiscount(bool $update = true): float
    {
        $this->discount = Discount::calculate($this);

        if ($update) {
            $this->save();
        }

        return $this->discount;
    }
}