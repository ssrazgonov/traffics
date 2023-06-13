<?php

namespace App\Actions\Appeal;

use App\Enums\AppealStatus;
use App\Models\Appeal;

class GetAppealAction
{
    public function __invoke($id)
    {
        $appeals = Appeal::query()->findOrFail($id);

        return $appeals;
    }
}
