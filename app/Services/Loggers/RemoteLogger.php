<?php

namespace App\Services\Loggers;

use App\Contracts\Logger;

class RemoteLogger implements Logger
{

    public function log(string $message): String
    {
        // TODO: Implement log() method.
        return "remote logger: $message";
    }
}
