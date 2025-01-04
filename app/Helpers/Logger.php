<?php

namespace App\Helpers;

class Logger
{

    private $step = 0;

    private $logs = [];

    public function push(array $content)
    {
        $this->step++;

        $this->logs[$this->step] = json_encode([
            'content' => $content
        ]);
    }

    public function print()
    {
        info($this->logs);
    }
}
