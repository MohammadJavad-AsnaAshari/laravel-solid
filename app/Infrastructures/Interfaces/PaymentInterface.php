<?php

namespace App\Infrastructures\Interfaces;

interface PaymentInterface
{
    public function makePayment(array $data);
}
