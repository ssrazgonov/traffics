<?php

namespace App\Dto\Action\Appeal;

use Illuminate\Http\UploadedFile;

class CreateAppealActionDto
{
    public int $trafficLightId;
    public string $typeOfCrash;
    public ?string $comment;
    public ?UploadedFile $file;
}
