<?php

namespace App\Services\Loggers;

use App\Contracts\Logger;

class FileLogger implements Logger
{

    public function log(string $message): String
    {
        // TODO: Implement log() method.
        return "file logger: $message";
    }
}
