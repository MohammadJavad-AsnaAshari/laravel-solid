<?php

namespace App\Services;

use App\Infrastructures\Interfaces\PaymentInterface;
use App\Infrastructures\PaymentTypes\PayPalPayment;
use App\Infrastructures\PaymentTypes\StripePayment;

class PaymentService
{
    public function setPayment(string $type): PaymentInterface
    {
        return match ($type) {
            'PayPal' => new PayPalPayment(),
            'Stripe' => new StripePayment(),
            // add more cases as needed...

            default => throw new \InvalidArgumentException("Payment type not supported")
        };
    }

    public function pay(PaymentInterface $paymentMethod, array $data)
    {
        return $paymentMethod->makePayment($data);
    }
}
