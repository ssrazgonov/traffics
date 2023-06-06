<?php

namespace App\Actions\Appeal;

use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Dto\Action\Appeal\CreateAppealActionResponseDto;
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
            ]);

            AppealLog::query()->create([
                'appeal_id' => $appeal->id,
                'log_text' => 'Сообщение создано',
            ]);

        } catch (\Throwable $e) {
            dd($e);
            $response->success = false;
        }

        $response->success = true;
        return $response;
    }
}
