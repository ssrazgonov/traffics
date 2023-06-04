<?php

namespace App\Dto\Action\Appeal;

class CreateAppealActionDto
{
    public int $trafficLightId;
    public string $typeOfCrash;
    public ?string $comment;
}
