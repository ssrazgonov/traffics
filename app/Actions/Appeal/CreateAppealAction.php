<?php

namespace App\Actions\Appeal;

use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Dto\Action\Appeal\CreateAppealActionResponseDto;
use App\Models\Appeal;

class CreateAppealAction
{
    public function __invoke(CreateAppealActionDto $dto)
    {
        $response = new CreateAppealActionResponseDto();

        try {

            Appeal::query()->create([

            ]);

        } catch (\Throwable $e) {

        }

        $response->success = true;
        return $response;
    }
}
