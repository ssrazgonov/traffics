<?php

namespace App\Enums;

enum Roles: string
{
    case OPERATOR = 'operator';
    case ENGINEER = 'engineer';
    case ADMIN = 'admin';
    case GUEST = 'guest';

    public function title(): string
    {
        return match ($this) {
            self::OPERATOR => 'Оператор',
            self::ENGINEER => 'Инженер',
            self::ADMIN => 'Админ',
            self::GUEST => 'Гость',
        };
    }
}
