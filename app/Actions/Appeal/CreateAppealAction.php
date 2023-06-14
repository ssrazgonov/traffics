<?php

namespace App\Actions\Appeal;

use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Dto\Action\Appeal\CreateAppealActionResponseDto;
use App\Enums\AppealStatus;
use App\Models\Appeal;
use App\Models\AppealLog;

class CreateAppealAction
{
    public function __invoke(CreateAppealActionDto $dto)
    {
        $response = new CreateAppealActionResponseDto();

        try {
            $appeal = Appeal::query()->create([
                'traffic_light_id' => $dto->trafficLightId,
                'type_of_crash' => $dto->typeOfCrash,
                'comment' => $dto->comment,
                'status' => AppealStatus::NOT_PROCESSED->value,
            ]);

            AppealLog::query()->create([
                'appeal_id' => $appeal->id,
                'log_text' => 'Статус заявки: ' . $appeal->status->getTitle() . ' Заявка создана.',
                'status' => $appeal->status
            ]);

        } catch (\Throwable $e) {
            $response->success = false;
        }

        $response->success = true;
        return $response;
    }
}
