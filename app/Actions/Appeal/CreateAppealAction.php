<?php

namespace App\Actions\Appeal;

use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Dto\Action\Appeal\CreateAppealActionResponseDto;
use App\Enums\AppealStatus;
use App\Models\Appeal;
use App\Models\AppealLog;
use App\Models\TrafficLight;
use Illuminate\Support\Str;

class CreateAppealAction
{
    public function __invoke(CreateAppealActionDto $dto)
    {
        $response = new CreateAppealActionResponseDto();

        try {

            $filename = Str::random(9) . '_' . now()->format('Y-m-d_h-m-s') . '__'. $dto->file->getClientOriginalName();

            $dto->file->move(storage_path('app/public/images_appeal'), $filename);
            $appeal = Appeal::query()->create([
                'traffic_light_id' => $dto->trafficLightId,
                'type_of_crash' => $dto->typeOfCrash,
                'comment' => $dto->comment,
                'status' => AppealStatus::NOT_PROCESSED->value,
                'comment_file' => $filename,
            ]);

            AppealLog::query()->create([
                'appeal_id' => $appeal->id,
                'log_text' => 'Статус заявки: ' . $appeal->status->title() . ' Заявка создана.',
                'status' => $appeal->status
            ]);

            $tf = TrafficLight::query()->findOrFail($dto->trafficLightId);

            $tf->status = 'not_working';
            $tf->save();

        } catch (\Throwable $e) {
            $response->success = false;
        }

        $response->success = true;
        return $response;
    }
}
