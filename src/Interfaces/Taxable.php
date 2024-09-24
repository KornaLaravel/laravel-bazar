<?php

namespace Cone\Bazar\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Taxable
{
    /**
     * Get the taxes for the model.
     */
    public function taxes(): MorphMany;

    /**
     * Get the tax base.
     */
    public function getTaxBase(): float;

    /**
     * Get the tax total.
     */
    public function getTaxTotal(): float;

    /**
     * Get the formatted tax.
     */
    public function getFormattedTaxTotal(): string;

    /**
     * Calculate the taxes.
     */
    public function calculateTaxes(): float;
}
