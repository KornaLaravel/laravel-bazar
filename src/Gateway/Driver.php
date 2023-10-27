<?php

namespace Cone\Bazar\Gateway;

use Cone\Bazar\Models\Order;
use Cone\Bazar\Models\Transaction;
use Cone\Bazar\Support\Driver as BaseDriver;
use Illuminate\Http\Request;

abstract class Driver extends BaseDriver
{
    /**
     * Process the payment.
     */
    abstract public function pay(Order $order, float $amount = null): Transaction;

    /**
     * Process the refund.
     */
    abstract public function refund(Order $order, float $amount = null): Transaction;

    /**
     * Get the URL of the transaction.
     */
    public function getTransactionUrl(Transaction $transaction): ?string
    {
        return null;
    }

    /**
     * Handle the checkout request.
     */
    public function checkout(Request $request, Order $order): Response
    {
        return new Response($order);
    }
}
