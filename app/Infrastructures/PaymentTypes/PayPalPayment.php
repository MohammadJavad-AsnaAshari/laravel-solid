<?php

namespace App\Infrastructures\PaymentTypes;

use App\Infrastructures\Interfaces\PaymentInterface;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PayPalPayment implements PaymentInterface
{

    public function makePayment(array $data): Model|Builder
    {
        // TODO: Implement makePayment() method.
        $payment = Payment::query()->create($data);

        return $payment->load('user');
    }
}
