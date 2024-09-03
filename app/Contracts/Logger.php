<?php

namespace App\Contracts;

interface Logger
{
    public function log(string $message): String;
}
