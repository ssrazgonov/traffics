<?php

namespace App\Actions\Appeal;

use App\Enums\AppealStatus;
use App\Models\Appeal;

class GetAppealsAction
{
    public function __invoke(AppealStatus $status, $operator_id = null, $engineer_id = null)
    {

        $appeals = Appeal::query()
            ->where('status', $status->value)
            ->when($operator_id)
            ->where('operator_id', $operator_id)
            ->when($engineer_id)
            ->where('engineer_id', $engineer_id)
            ->with([
                'trafficLight',
                'operator',
                'engineer'
            ])
            ->get();

        return $appeals;
    }
}
