<?php

namespace App\Enums;

enum AppealStatus: string
{
    case NOT_PROCESSED = 'not_processed';
    case PROCESSED = 'processed';
    case IN_WORK = 'in_work';
    case REJECTED = 'rejected';
    case CLOSED = 'closed';
    case Awaiting = 'awaiting';
    case Returned = 'returned';

    public function title(): string
    {
        return match ($this) {
            self::NOT_PROCESSED => 'Не обработана',
            self::PROCESSED => 'Обработана',
            self::IN_WORK => 'В работе',
            self::REJECTED => 'Отклонена',
            self::CLOSED => 'Закрыта',
            self::Awaiting => 'Ожидает проверки оператора',
            self::Returned => 'Возвращена на доработку',
        };
    }
}
