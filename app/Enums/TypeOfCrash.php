<?php

namespace App\Enums;

enum TypeOfCrash: string
{
    case NOT_LIGHT = 'NOT_LIGHT';
    case LIGHT_PERMANENTLY = 'LIGHT_PERMANENTLY';
    case YELLOW_LIGHT = 'YELLOW_LIGHT';
    case OTHER = 'OTHER';

    public function title(): string
    {
        return match ($this) {
            self::NOT_LIGHT => 'Не горит',
            self::LIGHT_PERMANENTLY => 'Горит Постоянно',
            self::YELLOW_LIGHT => 'Моргает желтым',
            self::OTHER => 'Другое',
        };
    }
}
