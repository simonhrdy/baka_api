<?php

namespace App\Enum;

enum Status: int
{
    case COMPLETED = 1;
    case NOT_STARTED = 0;

    public function getLabel(): string
    {
        return match ($this) {
            self::COMPLETED => 'Dohráno',
            self::NOT_STARTED => 'Nezahájeno',
        };
    }
}
