<?php

namespace Cone\Bazar\Interfaces\Models;

use Cone\Bazar\Interfaces\Discountable;
use Cone\Bazar\Interfaces\Itemable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface Order extends Discountable, Itemable
{
    /**
     * Get the cart for the order.
     */
    public function cart(): HasOne;

    /**
     * Get the transactions for the order.
     */
    public function transactions(): HasMany;

    /**
     * Create a payment transaction for the order.
     *
     * @return \Cone\Bazar\Models\Transaction
     */
    public function pay(?float $amount = null, ?string $driver = null, array $attributes = []): Transaction;

    /**
     * Create a refund transaction for the order.
     *
     * @return \Cone\Bazar\Models\Transaction
     */
    public function refund(?float $amount = null, ?string $driver = null, array $attributes = []): Transaction;

    /**
     * Get the total paid amount.
     */
    public function getTotalPaid(): float;

    /**
     * Get the total refunded amount.
     */
    public function getTotalRefunded(): float;

    /**
     * Get the total payable amount.
     */
    public function getTotalPayable(): float;

    /**
     * Get the total refundabke amount.
     */
    public function getTotalRefundable(): float;

    /**
     * Determine if the order is fully paid.
     */
    public function paid(): bool;

    /**
     * Determine if the order is fully refunded.
     */
    public function refunded(): bool;

    /**
     * Set the status by the given value.
     */
    public function markAs(string $status): void;
}